<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidUrlNotNull extends InvalidUrl
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
