<?php

namespace Arrilot\BitrixMigrations;

use Arrilot\BitrixMigrations\Constructors\IBlock;
use Arrilot\BitrixMigrations\Storages\BitrixDatabaseStorage;
use CModule;
use Exception;

/**
 * Class MigratorFacade
 *
 */
class MigratorFacade
{
    /**
     * @var string $migrationDir
     */
    private $migrationsDir;

    /**
     * @var Migrator $migrator
     */
    private $migrator;

    /**
     * @var string $templatesDir
     */
    private $templatesDir;

    /**
     * @param string|null $migrationDir
     */
    public function __construct(?string $migrationDir = null)   {
        $this->migrationsDir = $migrationDir ?? './migrations';
        $this->templatesDir = __DIR__ . './templates';

        CModule::IncludeModule("iblock");

        $config = [
            'table' => 'migrations',
            'dir' => $this->migrationsDir,
            'use_transaction' => true, // not required. default = false
            'default_fields' => [
                IBlock::class => [
                    'INDEX_ELEMENT' => 'N',
                    'INDEX_SECTION' => 'N',
                    'VERSION' => 2,
                    'SITE_ID' => 's1',
                ]
            ]
        ];

        $database = new BitrixDatabaseStorage($config['table']);
        $templates = new TemplatesCollection($this->templatesDir);
        $templates->registerBasicTemplates();

        $this->migrator = new Migrator($config, $templates, $database);
    }

    /**
     * @return Migrator
     */
    public function getMigrator() : Migrator
    {
        return $this->migrator;
    }


    /**
     * Ryn migrations.
     *
     * @return void
     */
    public function run() : void
    {
        if (!$this->needRun()) {
            return;
        }

        $this->migrator->runMigrations();
    }

    /**
     * @param string $name
     * @param string $template
     *
     * @return void
     * @throws Exception
     */
    public function make(string $name, string $template = 'default') : void
    {
        //    Запуск из PHP строки в админке Битрикса.
        //    require_once '../../local/modules/base.setup/libs/migrations/autoload.php';
        //
        //    use Arrilot\BitrixMigrations\MigratorFacade;
        //
        //    $migrator = new MigratorFacade($_SERVER["DOCUMENT_ROOT"].'/local/modules/base.setup/migrations');
        //    $migrator->run();
        //    $migrator->make('testing7', 'add_table');

        if (!$this->needRun()) {
            return;
        }

        $migrationsToRun = $this->migrator->getMigrationsToRun();

        foreach ($migrationsToRun as $migration) {
            if (stripos($migration, $name) !== false) {
                return;
            }
        }

        $this->migrator->createMigration(
            $name,
            $template
        );

    }

    /**
     * Можно ли работать с миграциями?
     *
     * @return bool
     */
    private function needRun() : bool
    {
        return true;
//        if (@defined('LOCAL_ENV')) {
//            return true;
//        }
//
//        return false;
    }
}