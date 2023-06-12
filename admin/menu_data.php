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
        'logs' => [
            'TAB' => 'Логи',
            'TITLE' => '',
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
        'apache_log_path' => [
            'label' => 'Путь к логам доступа Apache',
            'tab' => 'logs',
            'type' => 'input',
        ],
        'apache_log_limit' => [
            'label' => 'Максимальное количество записей (по умолчанию 10000)',
            'tab' => 'logs',
            'type' => 'number',
        ],

        'ap_log_header' => [
            'label' => '',
            'tab' => 'logs',
            'type' => 'html',
            'html' => '<div style="margin-top:25px;"><h3>Логи доступа Apache</h3></div>',
        ],

        'apache_access_logs' =>
            [
                'label' => '',
                'tab' => 'logs',
                'type' => 'html',
                'html' => apache_access_logs(),
            ],
        'php_log_header' => [
            'label' => '',
            'tab' => 'logs',
            'type' => 'html',
            'html' => '<div style="margin-top:25px;"><h3>Логи ошибок PHP</h3></div>',
        ],
        'php_error_logs' =>
            [
                'label' => '',
                'tab' => 'logs',
                'type' => 'html',
                'html' => php_error_logs(),
            ],
    ],
];

return $config;