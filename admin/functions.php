<?php
if (!function_exists('displayDebugStatus')) {
    function displayDebugStatus(): string
    {
        $file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/.settings.php';
        $params = include $file;

        ob_start(); ?>
        <div>
            <strong><?php echo $params['exception_handling']['value']['debug'] ? 'true' : 'false' ?></strong>
        </div>
        <?php return ob_get_clean();

    }
}

if (!function_exists('migrator_backup_db')) {
    function migrator_backup_db()
    {
        ob_start(); ?>
        <div>
            <button id="backup-db-button" class="cncl-button cncl-button_primary" style="margin-left: 10px">
                Backup БД
            </button>
        </div>
        <div id="dbdump-result-create" style="margin-top:10px;"></div>
        <?php

        return ob_get_clean();
    }
}

if (!function_exists('migrator_load_db')) {
    function migrator_load_db()
    {
        ob_start();
        ?>

        <div style="margin-top:10px">
            <button id="backup-load-db-button" class="cncl-button cncl-button_primary" style="margin-left: 10px">
                Load backup БД (аккуратнее!)
                <br>
                <span style="font-size:8px">(файл "название активной БД".sql из DOCUMENT_ROOT)</span>
            </button>
        </div>

        <div id="dbload-result-create" style="margin-top:10px;"></div>
        <?php

        return ob_get_clean();
    }
}
