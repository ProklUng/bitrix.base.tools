<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidIntegerishNotNull extends InvalidIntegerish
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
