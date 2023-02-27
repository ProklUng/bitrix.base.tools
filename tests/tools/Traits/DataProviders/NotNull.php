<?php

namespace Prokl\TestingTools\Traits\DataProviders;

/**
 * @internal
 */
trait NotNull
{
    /**
     * @param array $values
     *
     * @return array
     */
    public function notNull(array $values): array
    {
        return array_filter($values, static function ($value) {
            return $value !== null;
        });
    }
}
