<?php

namespace Prokl\DbCommands\Commands;

/**
 * Interface CommandsInterface
 */
interface CommandsInterface
{
    /**
     * Исполнение.
     *
     * @return int
     */
    public function execute(): int;

    /**
     * Название команды.
     *
     * @return string
     */
    public function name() : string;
}