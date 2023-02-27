<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use Prokl\TestingTools\Traits\AbstractDataProvider;
use stdClass;

class InvalidBoolean extends AbstractDataProvider
{
    public function values()
    {
        return [
            'array' => $this->arrayOfStrings(),
            'float-negative' => $this->floatNegative(),
            'float-positive' => $this->floatPositive(),
            'float-zero' => 0.0,
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
