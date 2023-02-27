<?php

namespace Prokl\TestingTools\Traits\DataProviders;

/**
 * @link http://php.net/manual/en/language.types.boolean.php#language.types.boolean.casting
 */

use stdClass;
use Prokl\TestingTools\Traits\AbstractDataProvider;

class Truthy extends AbstractDataProvider
{
    public function values()
    {
        return [
            'array-not-empty' => $this->arrayOfStrings(),
            'boolean-true' => true,
            'float-negative' => $this->floatNegative(),
            'float-positive' => $this->floatPositive(),
            'integer-negative' => $this->intNegative(),
            'integer-positive' => $this->intPositive(),
            'object' => new stdClass(),
            'string-not-empty' => $this->string(),
        ];
    }
}
