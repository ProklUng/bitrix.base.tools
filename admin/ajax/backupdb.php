<?php

use Bitrix\Main\Loader;
use Prokl\Module\ModuleForm;
use Prokl\Options\ModuleOptions;
use Prokl\Tools\DbDumper;

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

Loader::IncludeModule('base.setup');

try {
    $dumper = new DbDumper();
    $dumper->setFolder(ModuleOptions::getModuleUrl() . '/dumps');
    $result = $dumper->export();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    CMain::FinalActions();
}

$schema = CMain::IsHTTPS() ? 'https://' : 'http://';

echo json_encode(['success' => true, 'message' => $schema . $_SERVER['SERVER_NAME'] . $result]);
CMain::FinalActions();