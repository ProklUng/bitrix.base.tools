<?php

namespace Prokl\TestingTools\Traits\DataProviders;

class InvalidUuid extends InvalidString
{
    public function values()
    {
        $faker = $this->getFaker();

        return array_merge(parent::values(), [
            'md5' => $faker->md5,
            'sha1' => $faker->sha1,
            'sha256' => $faker->sha256,
            'string' => $faker->word,
        ]);
    }
}
