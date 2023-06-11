<?php
if(!is_object($GLOBALS["USER_FIELD_MANAGER"]))
	return false;

IncludeModuleLangFile(__FILE__);

CModule::IncludeModule('base.setup');

$menu = [
    [
        'parent_menu' => 'global_menu_content',
        'sort' => 1999,
        'text' => 'Утилитарный инструментарий',
        'title' => 'Утилитарный инструментарий',
        'url' => '/local/modules/base.setup/admin/admin_menu.php',
        'items_id' => 'menu_references',
        'items' => [ ],
    ],
];

return $menu;
