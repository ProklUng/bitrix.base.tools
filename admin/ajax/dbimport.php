<?php

use Prokl\Mysqldump\Import;

if (empty($_POST) || empty($_POST['host']) || empty($_POST['database']) || empty($_POST['login'])) {
    echo json_encode(['success' => false, 'message' => 'InvalidParams']);
}

$pathClass = $_SERVER['DOCUMENT_ROOT'] . '/local/modules/base.setup/libs/ifsnop/Mysqldump/import.php';
if (!@file_exists($pathClass)) {
    $pathClass = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/base.setup/libs/ifsnop/Mysqldump/import.php';
}

require_once $pathClass;

$importer = new Import(
    $_POST['host'],
    $_POST['database'],
    $_POST['login'],
    $_POST['password'],
);


$db =  '/' . $_POST['database'] . '.sql';
$dumpPath = $_SERVER['DOCUMENT_ROOT'] . $db;

if (!@file_exists($dumpPath)) {
    echo json_encode(['success' => false, 'message' => 'Дамп для импорта не найден']);
    die();
}

try {
    $importer->init();
} catch (\RuntimeException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка подключения к БД']);
    die();
}

$importer->importDatabase($db);

echo json_encode(['success' => true, 'message' => 'OK']);
die();
