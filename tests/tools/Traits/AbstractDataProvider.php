<?php

namespace Prokl\TestingTools\Traits;

use DateTime;

/**
 * Class AbstractDataProvider
 * @package Prokl\TestingTools\Traits
 */
abstract class AbstractDataProvider implements DataProviderInterface
{
    use DataProvidersTrait;

    /**
     * @return array|mixed
     */
    final public function data()
    {
        return $this->provideData($this->values());
    }

    /**
     * @return string[]
     */
    final protected function arrayOfStrings() : array
    {
        return $this->getFaker()->words;
    }

    /**
     * @return DateTime
     */
    final protected function dateTime()
    {
        return $this->getFaker()->dateTime;
    }

    /**
     * @return float
     */
    final protected function floatNegative() : float
    {
        return -1 * $this->floatPositive();
    }

    /**
     * @see https://github.com/fzaninotto/Faker/blob/v1.6.0/src/Faker/Provider/Base.php#L124-L138
     * @see https://github.com/fzaninotto/Faker/blob/v1.6.0/src/Faker/Provider/Base.php#L40-L48
     * @see https://en.wikipedia.org/wiki/2147483647_(number)
     *
     * @return float
     */
    final protected function floatPositive()
    {
        $faker = $this->getFaker();

        return $faker->randomFloat(
            $faker->randomDigitNotNull,
            1,
            2147483647
        );
    }

    /**
     * @return integer
     */
    final protected function intNegative() : int
    {
        return -1 * $this->intPositive();
    }

    /**
     * @return integer
     */
    final protected function intPositive() : int
    {
        return $this->getFaker()->numberBetween(1);
    }

    /**
     * @return resource
     */
    final protected function resource()
    {
        static $resource;

        if (null === $resource) {
            $resource = fopen(__FILE__, 'rb');
        }

        return $resource;
    }

    /**
     * @return string
     */
    final protected function string() : string
    {
        return $this->getFaker()->word;
    }
}
