<?php
/**
 * @var CMain $APPLICATION
 * @var CUser $USER
 */

use Prokl\Module\Module;
use Prokl\Module\ModuleForm;
use Prokl\Module\ModuleId;
use Prokl\Options\ModuleOptions;

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';

CModule::IncludeModule('base.setup');

$APPLICATION->SetTitle('Админка модуля');

$isPopup = isset($_REQUEST['popup']) && $_REQUEST['popup'] === 'Y';

if ($isPopup) {
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_popup_admin.php");
}
else {
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
}

CJSCore::Init(array('jquery2'));
CJSCore::Init(array('ajax'));
CJSCore::Init(array('fx'));

$module = new Module(
    [
        'MODULE_ID' => ModuleId::ID,
        'VENDOR_ID' => 'base',
        'ADMIN_FORM_ID' => 'basesetup_settings_form',
    ]
);


$menuData = include ModuleOptions::getModuleDir() . '/admin/menu_data.php';

$optionsManager = $module->getOptionsManager();

$optionsManager->addTabs(is_array($menuData['tabs']) ? $menuData['tabs'] : []);
$optionsManager->addOptions(is_array($menuData['options']) ? $menuData['options'] : []);

$module->showOptionsForm();

if ($isPopup) {
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_popup_admin.php");
}
else {
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
}