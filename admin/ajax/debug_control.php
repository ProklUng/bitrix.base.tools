<?php

use Prokl\Utils\SettingsManager;

define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_CHECK', true);
define("NO_KEEP_STATISTIC", true);
define("STOP_STATISTICS", true);

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
global $USER;

CModule::IncludeModule('base.setup');

if (!$USER->IsAdmin()) {
    echo json_encode(['success' => false]);
    CMain::FinalActions();
}

$settingManager = new SettingsManager();
$settingManager->debugReverse();

echo json_encode(['success' => true]);
CMain::FinalActions();
