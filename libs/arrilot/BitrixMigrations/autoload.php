<?php

require_once 'dependencies/collection/autoload.php';

require_once dirname(__FILE__).'/Interfaces/DatabaseStorageInterface.php';
require_once dirname(__FILE__).'/Interfaces/FileStorageInterface.php';
require_once dirname(__FILE__).'/Interfaces/MigrationInterface.php';

require_once dirname(__FILE__).'/Exceptions/MigrationException.php';
require_once dirname(__FILE__).'/Exceptions/SkipHandlerException.php';
require_once dirname(__FILE__).'/Exceptions/StopHandlerException.php';

require_once dirname(__FILE__).'/Traits/ClearCacheTrait.php';
require_once dirname(__FILE__).'/Traits/EmailEventTrait.php';
require_once dirname(__FILE__).'/Traits/EmailTemplateTrait.php';
require_once dirname(__FILE__).'/Traits/IblockPropertyTrait.php';
require_once dirname(__FILE__).'/Traits/MigrationsHlBlocksHelpersTrait.php';
require_once dirname(__FILE__).'/Traits/UserFieldTrait.php';
require_once dirname(__FILE__).'/Traits/UserGroupTrait.php';

require_once dirname(__FILE__).'/Storages/BitrixDatabaseStorage.php';
require_once dirname(__FILE__).'/Storages/FileStorage.php';

require_once dirname(__FILE__).'/Constructors/Constructor.php';
require_once dirname(__FILE__).'/Constructors/FieldConstructor.php';
require_once dirname(__FILE__).'/Constructors/HighloadBlock.php';
require_once dirname(__FILE__).'/Constructors/IBlock.php';
require_once dirname(__FILE__).'/Constructors/IBlockProperty.php';
require_once dirname(__FILE__).'/Constructors/IBlockPropertyEnum.php';
require_once dirname(__FILE__).'/Constructors/IBlockType.php';
require_once dirname(__FILE__).'/Constructors/UserField.php';

require_once dirname(__FILE__).'/Autocreate/Handlers/HandlerInterface.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/BaseHandler.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeGroupAdd.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeGroupDelete.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeGroupUpdate.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeHLBlockAdd.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeHLBlockDelete.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeHLBlockUpdate.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeIBlockAdd.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeIBlockDelete.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeIBlockPropertyAdd.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeIBlockPropertyDelete.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeIBlockPropertyUpdate.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeIBlockUpdate.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeUserTypeAdd.php';
require_once dirname(__FILE__).'/Autocreate/Handlers/OnBeforeUserTypeDelete.php';

require_once dirname(__FILE__).'/Autocreate/Manager.php';
require_once dirname(__FILE__).'/Autocreate/Notifier.php';

require_once dirname(__FILE__).'/BaseMigrations/BitrixMigration.php';

require_once dirname(__FILE__).'/Migrator.php';
require_once dirname(__FILE__).'/TemplatesCollection.php';
require_once dirname(__FILE__).'/Logger.php';
require_once dirname(__FILE__).'/Helpers.php';
require_once dirname(__FILE__).'/MigratorFacade.php';
