<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use Prokl\TestingTools\Traits\AbstractDataProvider;

class Scalar extends AbstractDataProvider
{
    public function values()
    {
        return [
            'boolean-false' => false,
            'boolean-true' => true,
            'float-negative' => $this->floatNegative(),
            'float-positive' => $this->floatPositive(),
            'float-zero' => 0.0,
            'integer-negative' => $this->intNegative(),
            'integer-positive' => $this->intPositive(),
            'integer-zero' => 0,
            'string' => $this->string(),
        ];
    }
}
