<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidJsonString extends InvalidString
{
    public function values()
    {
        $faker = $this->getFaker();

        return array_merge(parent::values(), [
            'string' => $faker->sentence,
            'string-invalid-json' => sprintf(
                '{"%s"}',
                $faker->sentence
            ),
        ]);
    }
}
