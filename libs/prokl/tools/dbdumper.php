<?php

namespace Prokl\Tools;

use Exception;
use PDO;
use Protocol\Mysqldump\Mysqldump;

/**
 * Class DbDumper
 */
class DbDumper
{
    /**
     * @var BitrixConfigs $bitrixConfigHandler
     */
    private $bitrixConfigHandler;

    /**
     * @var string $folder
     */
    private $folder = '';


    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (!class_exists(PDO::class)) {
            throw new Exception('На хостинге нет PDO');
        }

        $this->bitrixConfigHandler = new BitrixConfigs;
    }

    /**
     * @return string
     */
    public function getCurrentDbName() : string
    {
        $connections = ($this->bitrixConfigHandler->loadBitrixConfig('connections'))['default'];

        return $connections['database'];
    }

    /**
     * Экспорт базы.
     *
     * @return string
     * @throws Exception
     */
    public function export() : string {
        $connections = ($this->bitrixConfigHandler->loadBitrixConfig('connections'))['default'];
        $dbHost = $connections['host'];
        $dbName = $connections['database'];
        $dbLogin = $connections['login'];
        $dbPassword = $connections['password'];

            $dumpSettings = [
                'compress' => Mysqldump::NONE,
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

            $dump = new Mysqldump(
                "mysql:host=$dbHost;dbname=$dbName",
                $dbLogin,
                $dbPassword,
                $dumpSettings
            );

            $currentTimeStamp = date ('Ymdhi');

            $url = '/' . $dbName . '-' . $currentTimeStamp . '.sql';

            if ($this->folder) {
                if (!@file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $this->folder)) {
                    @mkdir($_SERVER['DOCUMENT_ROOT'] . '/' . $this->folder);
                }

                $url = $this->folder . '/' . $dbName . '-' . $currentTimeStamp . '.sql';
            }

            $path = $_SERVER['DOCUMENT_ROOT'] . $url;

            @unlink($path);

            $dump->start($path);

        return $url;
    }

    /**
     * @param string $folder
     * @return DbDumper
     */
    public function setFolder(string $folder): DbDumper
    {
        $this->folder = $folder;

        return $this;
    }
}