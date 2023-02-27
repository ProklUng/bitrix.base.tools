<?php

namespace Prokl\Commands;

use Bitrix\Main\Config\Configuration;
use Exception;
use Prokl\DbCommands\Utils\Import;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Ifsnop\Mysqldump as IMysqldump;

/**
 * Class DbImport
 * @package Prokl\DbCommands\Commands
 *
 * @since 12.12.2020
 */
class DbImport extends Command
{
    /**
     * @var Import $importer
     */
    private $importer;

    /**
     * @var string $backupDatabaseName
     */
    private $backupDatabaseName;

    /**
     * @var mixed
     */
    private $connection;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->connection = Configuration::getValue('connections')['default'];
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('db:import')
            ->setDescription('Import database')
            ->addArgument(
                'database_dump',
                InputArgument::REQUIRED,
                'Path to database dump'
            )
            ->addOption(
                'backup',
                null,
                InputOption::VALUE_OPTIONAL,
                'Backup original database?',
                'false'
            );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileDbDump = $input->getArgument('database_dump');
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].$fileDbDump)) {
            $output->writeln(sprintf(
                'File %s not found.',
                $fileDbDump,
            ));

            return 1;
        }

        /** Загрузить окружение. */
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

        $needBackupDatabase = $input->getOption('backup') === 'true';

        // Бэкап базы по опции.
        if ($needBackupDatabase !== false) {
            $output->writeln(sprintf(
                'Backuping of database %s.',
                $dbName,
            ));

            $this->backupDatabaseName = $this->exportDatabase(
                $dbHost,
                $dbName,
                $dbLogin,
                $dbPassword,
                $output
            );

            if (!$this->backupDatabaseName) {
                return 0;
            }
        }

        $this->importer = new Import(
            $dbHost,
            $dbName,
            $dbLogin,
            $dbPassword
        );

        // Дропинг базы.
        $output->writeln(sprintf(
            'Dropping database %s.',
            $dbName,
        ));

        try {
            $this->importer->init();
        } catch (Exception $e) {
            $output->writeln(sprintf(
                'Error connect to MySql server %s.',
                $e->getMessage()
            ));
        }

        $this->importer->dropDatabase($dbName);

        // Импорт новой базы.
        $output->writeln(sprintf(
            'Starting import dump %s to database %s.',
            $fileDbDump,
            $dbName
        ));

        try {
            $this->importDatabase($fileDbDump);
        } catch (Exception $e) {
            $output->writeln(sprintf(
                'Error importing database %s. : %s',
                $dbName,
                $e->getMessage()
            ));

            if ($needBackupDatabase !== false) {
                $output->writeln('Restoring base from backup.');
                $this->importDatabase($this->backupDatabaseName);
                unlink($_SERVER['DOCUMENT_ROOT'] . $this->backupDatabaseName);
            }

            return 1;
        }

        // Удалить резервную базу при опции после успешного завершения.
        if ($needBackupDatabase !== false) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $this->backupDatabaseName);
        }

        $output->writeln('Import dump to database completed.');

        return 0;
    }

    /**
     * Импортировать базу.
     *
     * @param string $fileDbDump Файл с дампом.
     *
     * @return void
     *
     * @throws Exception
     */
    private function importDatabase(string $fileDbDump) : void
    {
        $offset = null;
        do {
            $result = $this->importer->importFile($_SERVER['DOCUMENT_ROOT'] . $fileDbDump, $offset);
            $offset = $result['offset'] ?? null;
        } while ($offset !== null);
    }

    /**
     * Экспорт базы.
     *
     * @param string $dbHost
     * @param string $dbName
     * @param string $dbLogin
     * @param string $dbPassword
     * @param OutputInterface $output
     *
     * @return string
     */
    private function exportDatabase(
        string $dbHost,
        string $dbName,
        string $dbLogin,
        string $dbPassword,
        OutputInterface $output
    ) : string {
        try {
            $dumpSettings = [
                'compress' => IMysqldump\Mysqldump::NONE,
                'no-data' => false,
                'add-drop-table' => true,
                'single-transaction' => true,
                'lock-tables' => true,
                'add-locks' => true,
                'extended-insert' => true,
                'disable-foreign-keys-check' => true,
                'skip-triggers' => false,
                'add-drop-trigger' => true,
                'databases' => true,
                'add-drop-database' => true,
                'hex-blob' => true,
            ];

            $dump = new IMysqldump\Mysqldump(
                "mysql:host=$dbHost;dbname=$dbName",
                $dbLogin,
                $dbPassword,
                $dumpSettings
            );

            unlink($_SERVER['DOCUMENT_ROOT'].'/' . $dbName . '.sql');

            $dump->start($_SERVER['DOCUMENT_ROOT'] .'/' .$dbName. '.sql');
        } catch (\Exception $e) {
            echo 'mysqldump-php error: '.$e->getMessage();
            $output->writeln(sprintf(
                'Error backuping of database: %s',
                $e->getMessage()
            ));

            return '';
        }

        return '/' .$dbName. '.sql';
    }
}
