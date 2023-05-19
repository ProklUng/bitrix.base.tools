<?php

require_once 'collection/Support/helpers.php';

function __dm_autoload_719($name)
{
    $map = array(
        'Tightenco\Collect\Support\Traits\\EnumeratesValues' => 'collection/Support/Traits/EnumeratesValues.php',
        'Tightenco\\Collect\\Support\Traits\\Macroable' => 'collection/Support/Traits/Macroable.php',
        'Tightenco\Collect\Support\Traits\\Conditionable' => 'collection/Support/Traits/Conditionable.php',
        'Tightenco\\Collect\\Support\Traits\\Tappable' => 'collection/Support/Traits/Tappable.php',
        'Tightenco\\Collect\\Conditionable\\HigherOrderWhenProxy' => 'collection/Conditionable/HigherOrderWhenProxy.php',
        'Tightenco\\Collect\\Contracts\\Support\\Arrayable' => 'collection/Contracts/Support/Arrayable.php',
        'Tightenco\\Collect\\Contracts\\Support\\CanBeEscapedWhenCastToString' => 'collection/Contracts/Support/CanBeEscapedWhenCastToString.php',
        'Tightenco\\Collect\\Contracts\\Support\\Htmlable' => 'collection/Contracts/Support/Htmlable.php',
        'Tightenco\\Collect\\Contracts\\Support\\Jsonable' => 'collection/Contracts/Support/Jsonable.php',
        'Tightenco\\Collect\\Support\\Arr' => 'collection/Support/Arr.php',
        'Tightenco\\Collect\\Support\\Collection' => 'collection/Support/Collection.php',
        'Tightenco\\Collect\\Support\\Enumerable' => 'collection/Support/Enumerable.php',
        'Tightenco\\Collect\\Support\\HigherOrderCollectionProxy' => 'collection/Support/HigherOrderCollectionProxy.php',
        'Tightenco\\Collect\\Support\\HigherOrderWhenProxy' => 'collection/Support/HigherOrderWhenProxy.php',
        'Tightenco\\Collect\\Support\\LazyCollection' => 'collection/Support/LazyCollection.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\BaseHandler' => 'arrilot/BitrixMigrations/Autocreate/Handlers/BaseHandler.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\HandlerInterface' => 'arrilot/BitrixMigrations/Autocreate/Handlers/HandlerInterface.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeGroupAdd' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeGroupAdd.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeGroupDelete' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeGroupDelete.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeGroupUpdate' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeGroupUpdate.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeHLBlockAdd' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeHLBlockAdd.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeHLBlockDelete' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeHLBlockDelete.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeHLBlockUpdate' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeHLBlockUpdate.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeIBlockAdd' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeIBlockAdd.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeIBlockDelete' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeIBlockDelete.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeIBlockPropertyAdd' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeIBlockPropertyAdd.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeIBlockPropertyDelete' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeIBlockPropertyDelete.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeIBlockPropertyUpdate' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeIBlockPropertyUpdate.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeIBlockUpdate' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeIBlockUpdate.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeUserTypeAdd' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeUserTypeAdd.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Handlers\\OnBeforeUserTypeDelete' => 'arrilot/BitrixMigrations/Autocreate/Handlers/OnBeforeUserTypeDelete.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Manager' => 'arrilot/BitrixMigrations/Autocreate/Manager.php',
        'Arrilot\\BitrixMigrations\\Autocreate\\Notifier' => 'arrilot/BitrixMigrations/Autocreate/Notifier.php',
        'Arrilot\\BitrixMigrations\\BaseMigrations\\BitrixMigration' => 'arrilot/BitrixMigrations/BaseMigrations/BitrixMigration.php',
        'Arrilot\\BitrixMigrations\\BitrixDatabaseStorage' => 'arrilot/BitrixMigrations/MigratorFacade.php',
        'Arrilot\\BitrixMigrations\\Constructors\\Constructor' => 'arrilot/BitrixMigrations/Constructors/Constructor.php',
        'Arrilot\\BitrixMigrations\\Constructors\\HighloadBlock' => 'arrilot/BitrixMigrations/Constructors/HighloadBlock.php',
        'Arrilot\\BitrixMigrations\\Constructors\\IBlock' => 'arrilot/BitrixMigrations/Constructors/IBlock.php',
        'Arrilot\\BitrixMigrations\\Constructors\\IBlockProperty' => 'arrilot/BitrixMigrations/Constructors/IBlockProperty.php',
        'Arrilot\\BitrixMigrations\\Constructors\\IBlockPropertyEnum' => 'arrilot/BitrixMigrations/Constructors/IBlockPropertyEnum.php',
        'Arrilot\\BitrixMigrations\\Constructors\\IBlockType' => 'arrilot/BitrixMigrations/Constructors/IBlockType.php',
        'Arrilot\\BitrixMigrations\\Constructors\\UserField' => 'arrilot/BitrixMigrations/Constructors/UserField.php',
        'Arrilot\\BitrixMigrations\\Exceptions\\MigrationException' => 'arrilot/BitrixMigrations/Exceptions/MigrationException.php',
        'Arrilot\\BitrixMigrations\\Exceptions\\SkipHandlerException' => 'arrilot/BitrixMigrations/Exceptions/SkipHandlerException.php',
        'Arrilot\\BitrixMigrations\\Exceptions\\StopHandlerException' => 'arrilot/BitrixMigrations/Exceptions/StopHandlerException.php',
        'Arrilot\\BitrixMigrations\\Helpers' => 'arrilot/BitrixMigrations/Helpers.php',
        'Arrilot\\BitrixMigrations\\Interfaces\\DatabaseStorageInterface' => 'arrilot/BitrixMigrations/Interfaces/DatabaseStorageInterface.php',
        'Arrilot\\BitrixMigrations\\Interfaces\\FileStorageInterface' => 'arrilot/BitrixMigrations/Interfaces/FileStorageInterface.php',
        'Arrilot\\BitrixMigrations\\Interfaces\\MigrationInterface' => 'arrilot/BitrixMigrations/Interfaces/MigrationInterface.php',
        'Arrilot\\BitrixMigrations\\Logger' => 'arrilot/BitrixMigrations/Logger.php',
        'Arrilot\\BitrixMigrations\\Migrator' => 'arrilot/BitrixMigrations/Migrator.php',
        'Arrilot\\BitrixMigrations\\MigratorFacade' => 'arrilot/BitrixMigrations/MigratorFacade.php',
        'Arrilot\\BitrixMigrations\\Storages\\BitrixDatabaseStorage' => 'arrilot/BitrixMigrations/Storages/BitrixDatabaseStorage.php',
        'Arrilot\\BitrixMigrations\\Storages\\FileStorage' => 'arrilot/BitrixMigrations/Storages/FileStorage.php',
        'Arrilot\\BitrixMigrations\\TemplatesCollection' => 'arrilot/BitrixMigrations/TemplatesCollection.php',
        'Arrilot\\BitrixMigrations\\Traits\\ClearCacheTrait' => 'arrilot/BitrixMigrations/Traits/ClearCacheTrait.php',
        'Arrilot\BitrixMigrations\Traits\\EmailEventTrait' => 'arrilot/BitrixMigrations/Traits/EmailEventTrait.php',
        'Arrilot\BitrixMigrations\Traits\\mailTemplateTrait' => 'arrilot/BitrixMigrations/Traits/EmailTemplateTrait.php',
        'Arrilot\BitrixMigrations\Constructors\\FieldConstructor' => 'arrilot/BitrixMigrations/Constructors/FieldConstructor.php',
        'Arrilot\BitrixMigrations\Traits\\IblockPropertyTrait' => 'arrilot/BitrixMigrations/Traits/IblockPropertyTrait.php',
        'Arrilot\\BitrixMigrations\\Traits\\UserFieldTrait' => 'arrilot/BitrixMigrations/Traits/UserFieldTrait.php',
        'Arrilot\\BitrixMigrations\\Traits\\UserGroupTrait' => 'arrilot/BitrixMigrations/Traits/UserGroupTrait.php',
        'Arrilot\\BitrixMigrations\\Traits\\MigrationsHlBlocksHelpersTrait' => 'arrilot/BitrixMigrations/Traits/MigrationsHlBlocksHelpersTrait.php',
        'Arrilot\\BitrixMigrations\\Traits\\ModuleTrait' => 'arrilot/BitrixMigrations/Traits/ModuleTrait.php',
        'Ifsnop\\Mysqldump\\CompressBzip2' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\CompressGzip' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\CompressGzipstream' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\CompressManagerFactory' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\CompressMethod' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\CompressNone' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\Mysqldump' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\TypeAdapter' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\TypeAdapterDblib' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\TypeAdapterFactory' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\TypeAdapterMysql' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\TypeAdapterPgsql' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\TypeAdapterSqlite' => 'ifsnop/Mysqldump/Mysqldump.php',
        'Ifsnop\\Mysqldump\\DumpPdoAgnostic' => 'ifsnop/Mysqldump/DumpPdoAgnostic.php',
        'Prokl\\Commands\\ConsoleCommandConfigurator' => 'prokl/commands/ConsoleCommandConfigurator.php',
        'Prokl\\Commands\\DbExport' => 'prokl/commands/DbExport.php',
        'Prokl\\Commands\\DbImport' => 'prokl/commands/DbImport.php',
        'Prokl\\Commands\\DbDrop' => 'prokl/commands/DbDrop.php',
        'Prokl\\Commands\\DbTruncate' => 'prokl/commands/DbTruncate.php',
        'Prokl\\Commands\\LongLive' => 'prokl/commands/LongLive.php',
        'Prokl\\Commands\\EmailsCanBeSendCommand' => 'prokl/commands/EmailsCanBeSendCommand.php',
        'Prokl\\Commands\\Migrations\\AbstractCommand' => 'prokl/commands/Migrations/AbstractCommand.php',
        'Prokl\\Commands\\Migrations\\ArchiveCommand' => 'prokl/commands/Migrations/ArchiveCommand.php',
        'Prokl\\Commands\\Migrations\\InstallCommand' => 'prokl/commands/Migrations/InstallCommand.php',
        'Prokl\\Commands\\Migrations\\MakeCommand' => 'prokl/commands/Migrations/MakeCommand.php',
        'Prokl\\Commands\\Migrations\\MigrateCommand' => 'prokl/commands/Migrations/MigrateCommand.php',
        'Prokl\\Commands\\Migrations\\RollbackCommand' => 'prokl/commands/Migrations/RollbackCommand.php',
        'Prokl\\Commands\\Migrations\\StatusCommand' => 'prokl/commands/Migrations/StatusCommand.php',
        'Prokl\\Commands\\Migrations\\TemplatesCommand' => 'prokl/commands/Migrations/TemplatesCommand.php',
        'Prokl\\DbCommands\\Commands\\BaseCommand' => 'prokl/DbCommands/BaseCommand.php',
        'Prokl\\DbCommands\\Commands\\CommandsBag' => 'prokl/DbCommands/CommandsBag.php',
        'Prokl\\DbCommands\\Commands\\CommandsInterface' => 'prokl/DbCommands/CommandsInterface.php',
        'Prokl\\DbCommands\\Commands\\DbExport' => 'prokl/DbCommands/DbExport.php',
        'Prokl\\DbCommands\\Utils\\Import' => 'prokl/DbCommands/Utils/Import.php',
        'Prokl\\Utils\\LoaderBitrix' => 'prokl/utils/LoaderBitrix.php',
        'App\Log' => 'app/Log.php',
        'App\Monolog\ArrayFormatter' => 'app/Monolog/ArrayFormatter.php',
        'App\Monolog\ExceptionHandlerLog' => 'app/Monolog/ExceptionHandlerLog.php',
        'App\Monolog\LoggerFactory' => 'app/Monolog/LoggerFactory.php',
        'App\Monolog\FormatHelper' => 'app/Monolog/FormatHelper.php',

    );
    if (isset($map[$name])) {
        require $map[$name];
    }
}

if (!class_exists(Krumo::class)) {
    require_once 'krumo/class.krumo.php';
}

spl_autoload_register('__dm_autoload_719');
