<?php

namespace Prokl\Commands;

use Bitrix\Main\Config\Configuration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LongLive extends Command
{
    /**
     * @var mixed
     */
    private $connection;

    /**
     * @var string $outCode1
     */
    private $outCode1;

    /**
     * @var string
     */
    private $outCode2;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->connection = Configuration::getValue('connections')['default'];

        $key1 = 'DO_NOT_STEAL_OUR_BUS'; // OLDSITEEXPIREDATE
        $key2 = 'thRH4u67fhw87V7Hyr12Hwy0rFr'; // SITEEXPIREDATE

        $nowDate = date('mdY', time() + 60 * 60 * 24 * 30); // сегодня 07242015

        $codeDate1 = 'XX'.$nowDate[3].$nowDate[7].'XX'.$nowDate[0].$nowDate[5].'X'.$nowDate[2].'XX'.$nowDate[4].'X'.$nowDate[6].'X'.$nowDate[1].'X'; // OLDSITEEXPIREDATE
        $codeDate2 = 'X'.$nowDate[2].'X'.$nowDate[1].'XX'.$nowDate[0].$nowDate[6].'XX'.$nowDate[4].'X'.$nowDate[7].'X'.$nowDate[3].'XXX'.$nowDate[5]; // SITEEXPIREDATE

        $this->outCode1 = base64_encode($this->bitrixExpireDate($codeDate1, $key1)); // OLDSITEEXPIREDATE
        $this->outCode2 = base64_encode($this->bitrixExpireDate($codeDate2, $key2)); // SITEEXPIREDATE

        parent::__construct();
    }

    /**
     * @param string $dbName
     * @param string $dbLogin
     * @param string $dbPassword
     * @return void
     */
    public function processLongLive(string $dbName, string $dbLogin, string $dbPassword) : bool
    {
        if (!$this->modifyFile()) {
            return false;
        }

        $this->modifyDBRecord($dbName, $dbLogin, $dbPassword);
        $this->clear_dir(__DIR__.'/../../../../../../bitrix/managed_cache/MYSQL');

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('long:live')
            ->setDescription('Bitrix long live');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        [
            'host' => $dbHost,
            'database' => $dbName,
            'login' => $dbLogin,
            'password' => $dbPassword
        ] = $this->connection;

        if (!$dbHost || !$dbName || !$dbLogin) {
            $output->writeln('Env variables for database empty.');

            return 1;
        }

        $result = $this->processLongLive($dbHost, $dbLogin, $dbPassword);
        if ($result) {
            $output->writeln('Файл успешно исправлен.');
        } else {
            $output->writeln('Ошибка исправления файла.');
            die();
        }

        $output->writeln('Папка managed_cache удалена.');
        $output->writeln('Триал успешно сброшен!');

        return 0;
    }

    /**
     * @param string $date
     * @param        $key
     *
     * @return string
     */
    private function bitrixExpireDate(string $date, $key): string
    {
        $outCode = '';
        $x = 0;

        for ($i = 0; $i < strlen($date); $i++) {
            $outCode .= chr(ord($date[$i]) ^ ord($key[$x]));

            if ($x == strlen($key) - 1) {
                $x = 0;
            } else {
                $x = $x + 1;
            }
        }

        return $outCode;
    }

    /**
     * @return bool
     */
    private function modifyFile(): bool
    {
        if ($file = @fopen(__DIR__.'/../../../../../../bitrix/modules/main/admin/define.php', 'w')) {
            if (fwrite($file, "<?define('TEMPORARY_CACHE', '{$this->outCode1}');?>")) {
                fclose($file);
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * @param string $db
     * @param string $login
     * @param string $password
     *
     * @return void
     */
    private function modifyDBRecord(string $db, string $login, string $password): void
    {
        $mysqli = mysqli_connect("localhost", $login, $password, $db);
        mysqli_query($mysqli, "UPDATE b_option SET VALUE = '{$this->outCode2}' WHERE NAME = 'admin_passwordh'");
        if ($mysqli->errno) {
            printf("Could not update table: %s<br />", $mysqli->errno);
            die();
        }
    }

    /**
     * @param string $dir
     *
     * @return void
     */
    private function clear_dir(string $dir): void
    {
        if ($d = @opendir($dir)) {
            while (($entry = readdir($d)) !== false) {
                if ($entry !== '.' && $entry !== '..') {
                    if (is_dir($dir . DIRECTORY_SEPARATOR.$entry)) {
                        $this->clear_dir($dir . DIRECTORY_SEPARATOR.$entry);
                    } else {
                        unlink($dir . DIRECTORY_SEPARATOR.$entry);
                    }
                }
            }
            closedir($d);
            rmdir($dir);
        }
    }
}