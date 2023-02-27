<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidFloatNotNull extends InvalidFloat
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
