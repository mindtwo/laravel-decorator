<?php

namespace mindtwo\LaravelDecorator\Tests;

use mindtwo\LaravelDecorator\Providers\DecoratorServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [DecoratorServiceProvider::class];
    }
}
