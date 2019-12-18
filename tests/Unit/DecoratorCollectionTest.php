<?php

namespace mindtwo\LaravelDecorator\Tests\Unit;

use mindtwo\LaravelDecorator\Exceptions\DecoratorException;
use mindtwo\LaravelDecorator\Tests\Mocks\Decorator;
use mindtwo\LaravelDecorator\Tests\Mocks\Model;
use mindtwo\LaravelDecorator\Tests\TestCase;

class DecoratorCollectionTest extends TestCase
{
    /**
     * Get decorator collection test.
     *
     * @test
     */
    public function testGetDecoratorCollection()
    {
        $decorators = collect([Model::make()])->decorate(Decorator::class);

        $this->assertInstanceOf(Decorator::class, $decorators->first());
    }

    /**
     * Get decorator collection with default decorator test.
     *
     * @test
     */
    public function testGetDecoratorCollectionWithDefaultDecorator()
    {
        $decorators = collect([Model::make()])->decorate();

        $this->assertInstanceOf(Decorator::class, $decorators->first());
    }

    /**
     * Decoration fails when any item is not decoratable test.
     *
     * @test
     */
    public function testDecorationFailsWhenAnyItemIsNotDecoratable()
    {
        $this->expectException(DecoratorException::class);

        $decorators = collect([new \stdClass()])->decorate();
    }
}
