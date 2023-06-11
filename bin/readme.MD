
`php autoload.phar --file=/path/to/file_for_autoload.php --dir=/path/to/dir/where/php/file`

Скрипт создаст файл "/path/to/file_for_autoload.php" (если это возможно) с автозагрузчиком. Просто подключите его в вашем проекте:

```php
<?php
include '/path/to/file_for_autoload.php';
```

По-умолчанию, скрипт записывает относительные пути. Если вам нужно, чтобы были сгенерированы абсолютные пути - используйте команду:

`php autoload.phar --file=/path/to/file_for_autoload.php --dir=/path/to/dir/where/php/file --absolute-path`

Скопировать autoload.phar в `/local/`
Запускать из папки `/local/`

`php autoload.phar --file=libs/autoload.php --dir=libs`

Автолоад-файл сгенерируется в папке `local/libs`

Запуск из PHP командной строки Битрикса:

```php 
chdir($_SERVER['DOCUMENT_ROOT']. '/local/modules/base.setup/bin');
$output = [];
exec('php console db:export', $output);

var_dump($output);`