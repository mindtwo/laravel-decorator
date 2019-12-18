<?php

namespace mindtwo\LaravelDecorator\Tests\Mocks;

use Carbon\Carbon;
use mindtwo\LaravelDecorator\Interfaces\Decoratable;
use mindtwo\LaravelDecorator\Traits\HasDecorator;

class Model extends \Illuminate\Database\Eloquent\Model implements Decoratable
{
    use HasDecorator;

    /**
     * Return the default decorator full qualified class name.
     *
     * @return string
     */
    public function defaultDecorator(): string
    {
        return Decorator::class;
    }

    /**
     * Get some text.
     *
     * @param null $value
     */
    public function getSomeTextAttribute($value = null)
    {
        return 'Lorem ipsum';
    }

    /**
     * Get some date.
     *
     * @param null $value
     */
    public function getSomeDateAttribute($value = null)
    {
        return Carbon::create(2020, 1, 20);
    }

    /**
     * Get another text.
     *
     * @return string
     */
    public function anotherText()
    {
        return 'Dolor sit amet';
    }
}
