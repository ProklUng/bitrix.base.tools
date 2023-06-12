<?php

namespace Prokl\Options;

use Prokl\Module\ModuleId;

/**
 * Class ModuleOptions
 */
class ModuleOptions
{
    /**
     * @return string
     */
    public static function getPathToApacheErrorLog() : string
    {
        return (string)OptionHelper::facade()->getOption('apache_log_path');
    }

    /**
     * @return int
     */
    public static function getLogLimit() : int
    {
        return (int)OptionHelper::facade()->getOption('apache_log_limit', 5000);
    }

    /**
     * URL, где лежит модуль.
     *
     * @return string
     */
    public static function getModuleUrl() : string
    {
        foreach (['/local/modules/', '/bitrix/modules/'] as $path) {
            if (@file_exists($_SERVER['DOCUMENT_ROOT']. $path . ModuleId::ID)) {
                return $path . ModuleId::ID;
            }
        }

        return '';
    }

    /**
     * Директория, где лежит модуль.
     *
     * @return string
     */
    public static function getModuleDir() : string
    {
        foreach (['/local/modules/', '/bitrix/modules/'] as $path) {
            if (@file_exists($_SERVER['DOCUMENT_ROOT']. $path . ModuleId::ID)) {
                return $_SERVER['DOCUMENT_ROOT']. $path . ModuleId::ID;
            }
        }

        return '';
    }
}