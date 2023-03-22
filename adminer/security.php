<?php

class BitrixAdminerSecurity
{
    /**
     * @return void
     */
    public static function check() : void
    {
        static::bootstrap();

        require_once $_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php";

        global $USER;

        if (!$USER->IsAdmin()) {
            die('Only admin allowed');
        }

    }

    private static function bootstrap() : void
    {
        $documentRootEnvName = 'DOCUMENT_ROOT';
        $documentRoot        = getenv($documentRootEnvName);

        if ($documentRoot === false) {
            $documentRoot = dirname(dirname(__DIR__));
            if (!is_dir($documentRoot . '/bitrix/') || !is_file($documentRoot . '/bitrix/modules/main/include.php')) {
                die(sprintf('Bitrix not found. Setup environment variable `%s`', $documentRootEnvName));
            }
        }

        if (!is_dir($documentRoot)) {
            throw new RuntimeException(
                sprintf(
                    'Document root folder doesn`t exist: %s',
                    $documentRoot
                )
            );
        }

        $_SERVER['DOCUMENT_ROOT'] = $documentRoot;
    }
}