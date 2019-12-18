<?php

namespace mindtwo\LaravelDecorator\Tests\Mocks;

class Decorator extends \mindtwo\LaravelDecorator\Decorator
{
    public function someDate()
    {
        return $this->model->some_date->format('d.m.Y');
    }
}
