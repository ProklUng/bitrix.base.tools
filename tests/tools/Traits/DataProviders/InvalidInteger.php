<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use Prokl\TestingTools\Traits\AbstractDataProvider;
use stdClass;

class InvalidInteger extends AbstractDataProvider
{
    public function values()
    {
        return [
            'array' => $this->arrayOfStrings(),
            'boolean-false' => false,
            'boolean-true' => true,
            'float-negative' => $this->floatNegative(),
            'float-positive' => $this->floatPositive(),
            'float-zero' => 0.0,
            'integer-negative-casted-to-string' => (string) $this->intNegative(),
            'integer-positive-casted-to-string' => (string) $this->intPositive(),
            'integer-zero-casted-to-string' => (string) 0,
            'null' => null,
            'object' => new stdClass(),
            'resource' => $this->resource(),
            'string' => $this->string(),
        ];
    }
}
