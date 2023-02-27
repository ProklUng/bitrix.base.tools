<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidBooleanNotNull extends InvalidBoolean
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
