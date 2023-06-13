<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

global $APPLICATION;

include_once 'functions.php';

$config = [
    'tabs' => [
        'tools' => [
            'TAB' => 'Инструментарий',
            'TITLE' => 'Различные инструменты',
        ],
    ],
    'options' => [
        [
            'type' => 'html',
            'label' => ' Текущее значение DEBUG: ',
            'html' => displayDebugStatus(),
            'title' => '',
            'tab' => 'tools',
        ],
        'control_debug_mode' => [
            'type' => 'button',
            'label' => 'Переключение режима DEBUG',
            'handler' => 'controlDebug',
            'styles' => 'cncl-button_primary',
            'tab' => 'tools',
        ],
        'debug_delimiter' => [
            'label' => '',
            'tab' => 'tools',
            'type' => 'html',
            'html' => '<div style="margin-top:25px;"><hr></div>',
        ],
        'backup_db' =>
            [
                'label' => '',
                'tab' => 'tools',
                'type' => 'html',
                'html' => migrator_backup_db(),
            ],
        'load_db' =>
            [
                'label' => '',
                'tab' => 'tools',
                'type' => 'html',
                'html' => migrator_load_db(),
            ],
        'db_delimiter' => [
            'label' => '',
            'tab' => 'tools',
            'type' => 'html',
            'html' => '<div style="margin-top:25px;"><hr></div>',
        ],
        'long_live' =>
            [
                'label' => '',
                'tab' => 'tools',
                'type' => 'html',
                'html' => long_live(),
            ],
    ],
];

return $config;