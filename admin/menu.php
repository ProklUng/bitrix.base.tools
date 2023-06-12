<?php

use Prokl\Options\ModuleOptions;

if(!is_object($GLOBALS["USER_FIELD_MANAGER"]))
	return false;

IncludeModuleLangFile(__FILE__);

CModule::IncludeModule('base.setup');

$urlAdminModule = ModuleOptions::getModuleUrl() . '/admin/admin_menu.php';

$menu = [
    [
        'parent_menu' => 'global_menu_content',
        'sort' => 1999,
        'text' => 'Утилитарный инструментарий',
        'title' => 'Утилитарный инструментарий',
        'url' => $urlAdminModule,
        'items_id' => 'menu_references',
        'items' => [ ],
    ],
];

return $menu;
