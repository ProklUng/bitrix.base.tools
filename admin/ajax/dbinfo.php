<?php

use Bitrix\Main\Loader;
use Protocol\Migrations\BitrixConfigs;

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

Loader::IncludeModule('protocol.migrations');

$bitrixConfigHandler = new BitrixConfigs;
$connection = ($bitrixConfigHandler->loadBitrixConfig('connections'))['default'];

echo json_encode(['success' => true, 'connection' => $connection]);
CMain::FinalActions();