<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidNumericNotNull extends InvalidNumeric
{
    use NotNull;

    public function values()
    {
        return $this->notNull(parent::values());
    }
}
