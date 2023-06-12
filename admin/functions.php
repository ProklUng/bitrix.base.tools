<?php

use Prokl\Options\ModuleOptions;
use Prokl\Tools\ServerLogs;

if (!function_exists('displayDebugStatus')) {
    function displayDebugStatus(): string
    {
        $file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/.settings.php';
        $params = include $file;

        ob_start(); ?>
        <div>
            <strong><?php echo $params['exception_handling']['value']['debug'] ? 'true' : 'false' ?></strong>
        </div>
        <?php return ob_get_clean();

    }
}

if (!function_exists('apache_access_logs')) {
    function apache_access_logs() : string
    {
        //    $dir = dirname(ini_get('error_log'));
       //     $dir .= '/dev5_access.log';
        $serverLogs = new ServerLogs();
        $apacheAccessLog = $serverLogs->apacheAccessLog(
                ModuleOptions::getPathToApacheErrorLog(),
                ModuleOptions::getLogLimit()
        );

        if (!empty($_GET['filter_access-filter'])) {
            $apacheAccessLog = $serverLogs->filterLog($apacheAccessLog, (string)$_GET['filter_access-filter']);
        }

        $filter = $serverLogs->generateViewFilterLog('access-filter', (string)$_GET['filter_access-filter']);

        return $filter . $serverLogs->generateViewLog($apacheAccessLog, 'apache-access-log');
    }
}

if (!function_exists('php_error_logs')) {
    function php_error_logs() : string
    {
        $serverLogs = new ServerLogs();
        $phpLogs = $serverLogs->phpErrorsLogLines(ModuleOptions::getLogLimit());

        if (!empty($_GET['filter_php-error'])) {
            $phpLogs = $serverLogs->filterLog($phpLogs, (string)$_GET['filter_php-error']);
        }

        $filter = $serverLogs->generateViewFilterLog('php-error', (string)$_GET['filter_php-error']);

        return $filter . $serverLogs->generateViewLog($phpLogs, 'php-error-log');
    }
}

if (!function_exists('long_live')) {
    function long_live() : string {
        ob_start(); ?>
        <div>
            <button id="longlive-db-button" class="cncl-button cncl-button_primary" style="margin-left: 10px">
                Долгая жизнь триала
            </button>
        </div>
        <div id="longlive-result-create" style="margin-top:10px;"></div>
        <?php

        return (string)ob_get_clean();
    }
}
if (!function_exists('migrator_backup_db')) {
    function migrator_backup_db() : string
    {
        ob_start(); ?>
        <div>
            <button id="backup-db-button" class="cncl-button cncl-button_primary" style="margin-left: 10px">
                Backup БД
            </button>
        </div>
        <div id="dbdump-result-create" style="margin-top:10px;"></div>
        <?php

        return (string)ob_get_clean();
    }
}

if (!function_exists('migrator_load_db')) {
    function migrator_load_db()
    {
        ob_start();
        ?>

        <div style="margin-top:10px">
            <button id="backup-load-db-button" class="cncl-button cncl-button_primary" style="margin-left: 10px">
                Load backup БД (аккуратнее!)
                <br>
                <span style="font-size:8px">(файл "название активной БД".sql из DOCUMENT_ROOT)</span>
            </button>
        </div>

        <div id="dbload-result-create" style="margin-top:10px;"></div>
        <?php

        return ob_get_clean();
    }
}
