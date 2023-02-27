<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use stdClass;
use Prokl\TestingTools\Traits\AbstractDataProvider;

class InvalidNumeric extends AbstractDataProvider
{
    public function values()
    {
        return [
            'array' => $this->arrayOfStrings(),
            'boolean-false' => false,
            'boolean-true' => true,
            'null' => null,
            'object' => new stdClass(),
            'resource' => $this->resource(),
            'string' => $this->string(),
        ];
    }
}
