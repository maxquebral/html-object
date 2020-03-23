<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{

    /**
     * @var \Faker\Generator
     */
    private ?\Faker\Generator $faker = null;

    /**
     * @return \Faker\Generator
     */
    protected function getFaker(): Generator
    {
        if ($this->faker !== null) {
            return $this->faker;
        }

        return $this->faker = Factory::create();
    }
}