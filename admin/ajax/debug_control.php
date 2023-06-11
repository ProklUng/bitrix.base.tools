<?php

use Prokl\Utils\SettingsManager;

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
