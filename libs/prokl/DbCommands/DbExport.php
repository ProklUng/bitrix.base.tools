<?php

namespace Prokl\DbCommands\Commands;

use Bitrix\Main\Config\Configuration;
use Ifsnop\Mysqldump as IMysqldump;

/**
 * Class DbExport
 * Дамп базы данных.
 */
class DbExport extends BaseCommand
{
    /**
     * @var mixed $connection
     */
    private $connection;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->connection = Configuration::getValue('connections')['default'];
    }

    /**
     * @inheritDoc
     */
    public function execute(): int
    {
        [
            'host' => $dbHost,
            'database' => $dbName,
            'login' => $dbLogin,
            'password' => $dbPassword
        ] = $this->connection;

        if (!$dbHost || !$dbName || !$dbLogin) {
            return 1;
        }

        $backupDatabaseName = $this->exportDatabase(
            $dbHost,
            $dbName,
            $dbLogin,
            $dbPassword,
        );

        if (!$backupDatabaseName) {
            return 1;
        }

        return 0;
    }

    /**
     * @inheritDoc
     */
    public function name() : string
    {
        return $this->commandName;
    }

    /**
     * Экспорт базы.
     *
     * @param string $dbHost
     * @param string $dbName
     * @param string $dbLogin
     * @param string $dbPassword
     *
     * @return string
     */
    private function exportDatabase(
        string $dbHost,
        string $dbName,
        string $dbLogin,
        string $dbPassword
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

            @unlink($_SERVER['DOCUMENT_ROOT'].'/' . $dbName . '.sql');

            $dump->start($_SERVER['DOCUMENT_ROOT'] .'/' .$dbName. '.sql');
        } catch (\Exception $e) {
            echo 'mysqldump-php error: '.$e->getMessage();
            return '';
        }

        return '/' .$dbName. '.sql';
    }
}
