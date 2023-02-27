<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidIntegerNotNull extends InvalidInteger
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
