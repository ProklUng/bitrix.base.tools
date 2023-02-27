<?php

namespace Prokl\TestingTools\Traits\DataProviders;

use Prokl\TestingTools\Traits\AbstractDataProvider;

class Elements extends AbstractDataProvider
{
    /**
     * @var array
     */
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function values()
    {
        return $this->values;
    }
}
