<?php

namespace mindtwo\LaravelDecorator\Tests\Feature;

use Illuminate\Database\Eloquent\Model;
use mindtwo\LaravelDecorator\Interfaces\Decoratable;
use mindtwo\LaravelDecorator\Tests\TestCase;
use mindtwo\LaravelDecorator\Traits\HasDecorator;
use Mockery;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        $model = Mockery::mock(Decoratable::class);

        $this->assertTrue(true);
    }
}
