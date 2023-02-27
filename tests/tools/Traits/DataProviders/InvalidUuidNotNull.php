<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidUuidNotNull extends InvalidUuid
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
