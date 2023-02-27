<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use stdClass;
use Prokl\TestingTools\Traits\AbstractDataProvider;

class InvalidIntegerish extends AbstractDataProvider
{
    public function values()
    {
        return [
            'array' => $this->arrayOfStrings(),
            'boolean-false' => false,
            'boolean-true' => true,
            'float-negative' => $this->floatNegative(),
            'float-negative-casted-to-string' => (string) $this->floatNegative(),
            'float-positive' => $this->floatPositive(),
            'float-positive-casted-to-string' => (string) $this->floatPositive(),
            'null' => null,
            'object' => new stdClass(),
            'resource' => $this->resource(),
            'string' => $this->string(),
        ];
    }
}
