<?php

$documentRoot = $_SERVER['DOCUMENT_ROOT'] = __DIR__ . DIRECTORY_SEPARATOR . '../../../..';
$GLOBALS['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];

if (!is_dir($documentRoot)) {
    throw new RuntimeException(
        sprintf(
            'Document root folder doesn`t exist: %s',
            $documentRoot
        )
    );
}

require_once 'vendor/autoload.php';
require_once 'autoload.php';

define('LANGUAGE_ID', 'pa');
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('LOG_FILENAME', 'php://stderr');
define('BX_NO_ACCELERATOR_RESET', true);
define('STOP_STATISTICS', true);
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);
define('NO_AGENT_CHECK', true);


require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

// Альтернативный способ вывода ошибок типа "DB query error.":
$GLOBALS['DB']->debug = true;

global $DB;
$app = \Bitrix\Main\Application::getInstance();
$con = $app->getConnection();
$DB->db_Conn = $con->getResource();

// "authorizing" as admin
$_SESSION['SESS_AUTH']['USER_ID'] = 1;
