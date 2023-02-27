<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use stdClass;
use Prokl\TestingTools\Traits\AbstractDataProvider;

class InvalidString extends AbstractDataProvider
{
    public function values()
    {
        return [
            'array' => $this->arrayOfStrings(),
            'boolean-false' => false,
            'boolean-true' => true,
            'float' => $this->floatPositive(),
            'integer' => $this->intPositive(),
            'null' => null,
            'resource' => $this->resource(),
            'object' => new stdClass(),
        ];
    }
}
