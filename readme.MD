# Модуль Base.setup для Bitrix

## Зачем?

Так получилось, что попал работать в организацию с "упрощенной" системой разработки. Композера нет, доступа по ssh нет, 
"классическая" битриксовая кодобаза, тотальное jQuery, всяческие технические ограничения. Дабы облегчить себе жизнь и сохранить, пусть в сильно упрощенном виде, 
привычную среду, пришлось вынести в отдельный модуль некоторый функционал. 

Как-то - миграции (по классике - https://github.com/arrilot/bitrix-migrations), консольные команды импорта-экспорта БД (запускаемых - в том числе - из окошка битриксовой админки "Командная PHP-строка"). 

## Установка

composer.json:

```json
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/proklung/bitrix.base.tools"
        }
    ]
```

```composer require proklung/bitrix.base.tools```

## Функционал

Миграции:

~~~php

           // Запуск из PHP строки в админке Битрикса.
           require_once '../../local/modules/base.setup/libs/migrations/autoload.php';
       
           use Arrilot\BitrixMigrations\MigratorFacade;
       
           $migrator = new MigratorFacade($_SERVER["DOCUMENT_ROOT"].'/local/modules/base.setup/migrations');
           $migrator->run();
           $migrator->make('testing7', 'add_table');

~~~

Или так:

~~~php
chdir($_SERVER['DOCUMENT_ROOT']. '/local/modules/base.setup/bin');
$output = [];
exec('php console db:export', $output);

var_dump($output);
~~~

"Автозапись" миграций:

~~~php
Arrilot\BitrixMigrations\Autocreate\Manager::init(
    $_SERVER["DOCUMENT_ROOT"].'/local/modules/base.setup/migrations',
    $_SERVER["DOCUMENT_ROOT"].'/local/modules/base.setup/libs/arrilot/BitrixMigrations/templates',
);
~~~

Прочее:

~~~php

Генерация файла с автозагрузкой классов (тоска по Композеру)

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


~~~

### Symfony VarDumper 5.4

См. - https://symfony.com/doc/5.4/components/var_dumper.html

### Adminer

См. - https://github.com/vrana/adminer

Запуск:

`/local/modules/council.setup/bin/adminer.php`

По умолчанию (так работаю локально) пароль на базу не установлен. Псевдо-пароль: `1111111111`.