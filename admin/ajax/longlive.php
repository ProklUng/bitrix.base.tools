<?php

use Bitrix\Main\Config\Configuration;
use Prokl\Commands\ConsoleCommandConfigurator;
use Prokl\Commands\LongLive;

define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_CHECK', true);
define("NO_KEEP_STATISTIC", true);
define("STOP_STATISTICS", true);

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";

global $USER;

if (!$USER->IsAdmin()) {
    echo json_encode(['success' => false, 'message' => 'Invalid params']);
    CMain::FinalActions();
}

CModule::IncludeModule('base.setup');

$connection = Configuration::getValue('connections')['default'];
[
    'host' => $dbHost,
    'database' => $dbName,
    'login' => $dbLogin,
    'password' => $dbPassword
] = $connection;

$longLiveCommand = new LongLive();
$result = $longLiveCommand->processLongLive($dbName, $dbLogin, $dbPassword);

echo json_encode(['success' => true, 'result' => $result]);
CMain::FinalActions();