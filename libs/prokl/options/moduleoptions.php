<?php

namespace Prokl\Options;

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
}