<?php

use Bitrix\Main\Loader;
use Protocol\Migrations\BitrixConfigs;

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