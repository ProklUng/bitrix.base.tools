<?php

namespace Prokl\DbCommands\Commands;

/**
 * Class BaseCommand
 */
class BaseCommand implements CommandsInterface
{
    /**
     * @var string $commandName
     */
    protected $commandName = 'autoload';

    /**
     * @return static
     */
    public static function facade()
    {
        return new static;
    }

    /**
     * @inheritDoc
     */
    public function execute(): int
    {

    }

    /**
     * @inheritDoc
     */
    public function name() : string
    {
        return $this->commandName;
    }
}