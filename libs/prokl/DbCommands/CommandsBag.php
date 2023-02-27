<?php

namespace Prokl\DbCommands\Commands;

/**
 * Class CommandsBag
 *
 * @internal Использование (в командной строке PHP Битрикса):
 *
 * use Prokl\DbCommands\Commands\CommandsBag;
 *
 *  CommandsBag::run('db.export');
 */
class CommandsBag
{
    /**
     * @var CommandsInterface[] $commands
     */
    private $commands;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $export = new DbExport();

        $this->commands[$export->name()] = $export;
    }

    /**
     * Run.
     *
     * @param string $commandName
     * @return void
     */
    public static function run(string $commandName)
    {
        $self = new static;

        foreach ($self->commands as $name => $command) {
            if ($name === $commandName) {
                $command->execute();
            }
        }
    }
}