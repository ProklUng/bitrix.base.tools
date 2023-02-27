<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidUrl extends InvalidString
{
    public function values()
    {
        $faker = $this->getFaker();

        return [
            'string-path-only' => implode('/', $faker->words),
            'string-word-only' => $faker->word,
        ];
    }
}
