<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidScalarNotNull extends InvalidScalar
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
