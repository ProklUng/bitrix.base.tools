<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use stdClass;
use Prokl\TestingTools\Traits\AbstractDataProvider;

class InvalidFloat extends AbstractDataProvider
{
    public function values()
    {
        return [
            'array' => $this->arrayOfStrings(),
            'boolean-false' => false,
            'boolean-true' => true,
            'float-negative-casted-to-string' => (string) $this->floatNegative(),
            'float-positive-casted-to-string' => (string) $this->floatPositive(),
            'float-zero-casted-to-string' => (string) 0.0,
            'integer-negative' => $this->intNegative(),
            'integer-positive' => $this->intPositive(),
            'integer-zero' => 0,
            'null' => null,
            'object' => new stdClass(),
            'resource' => $this->resource(),
            'string' => $this->string(),
        ];
    }
}
