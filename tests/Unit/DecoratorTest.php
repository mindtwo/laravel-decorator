<?php

namespace mindtwo\LaravelDecorator\Tests\Unit;

use mindtwo\LaravelDecorator\Tests\Mocks\Decorator;
use mindtwo\LaravelDecorator\Tests\Mocks\Model;
use mindtwo\LaravelDecorator\Tests\TestCase;

class DecoratorTest extends TestCase
{
    /**
     * Get decorator test.
     *
     * @test
     */
    public function testGetDecorator()
    {
        $decorator = Model::make()->decorate(Decorator::class);

        $this->assertInstanceOf(Decorator::class, $decorator);
    }

    /**
     * Get default decorator test.
     *
     * @test
     */
    public function testGetDefaultDecorator()
    {
        $decorator = Model::make()->decorate();

        $this->assertInstanceOf(Decorator::class, $decorator);
    }

    /**
     * Forward property access to model test.
     *
     * @test
     */
    public function testForwardPropertyAccessToModel()
    {
        $decorator = Model::make()->decorate();

        $this->assertEquals('Lorem ipsum', $decorator->some_text);
    }

    /**
     * Overrides model proerty access test.
     *
     * @test
     */
    public function testOverridesModelPropertyAccess()
    {
        $decorator = Model::make()->decorate();

        $this->assertEquals('20.01.2020', $decorator->some_date);
    }

    /**
     * Forward calls to model test.
     *
     * @test
     */
    public function testForwardCallsToModel()
    {
        $decorator = Model::make()->decorate();

        $this->assertEquals('Dolor sit amet', $decorator->anotherText());
    }
}
