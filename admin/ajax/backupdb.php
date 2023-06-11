<?php

use Bitrix\Main\Loader;
use Prokl\Module\ModuleForm;
use Prokl\Tools\DbDumper;

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";

global $USER;

if (!$USER->IsAdmin()) {
    echo json_encode(['success' => false, 'message' => 'Invalid params']);
    CMain::FinalActions();
}

Loader::IncludeModule('base.setup');

try {
    $dumper = new DbDumper();
    $dumper->setFolder(ModuleForm::getModuleUrl() . '/dumps');
    $result = $dumper->export();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    CMain::FinalActions();
}

$schema = CMain::IsHTTPS() ? 'https://' : 'http://';

echo json_encode(['success' => true, 'message' => $schema . $_SERVER['SERVER_NAME'] . $result]);
CMain::FinalActions();