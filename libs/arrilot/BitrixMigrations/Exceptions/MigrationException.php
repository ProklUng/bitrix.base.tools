<?php

namespace Arrilot\BitrixMigrations\Exceptions;

use Exception;

class MigrationException extends Exception
{
    protected $code = 1;
}
