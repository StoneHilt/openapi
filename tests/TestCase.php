<?php

namespace StoneHilt\OpenApi\Tests;

use StoneHilt\OpenApi\OpenApi;
use StoneHilt\OpenApi\Generator;
use StoneHilt\OpenApi\OpenApiServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            OpenApiServiceProvider::class,
        ];
    }

    protected function generate(): OpenApi
    {
        return $this->app[Generator::class]->generate();
    }
}
