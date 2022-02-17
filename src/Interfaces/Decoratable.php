<?php

namespace mindtwo\LaravelDecorator\Interfaces;

use mindtwo\LaravelDecorator\Exceptions\DecoratorException;

interface Decoratable
{
    /**
     * Get the default decorator class path.
     *
     * @return string|null
     */
    public function getDefaultDecorator();

    /**
     * Determinate if the model use a default decorator.
     *
     * @return bool
     */
    public function hasDefaultDecorator();

    /**
     * Decorate the model.
     *
     * @param  string|null  $decorator
     * @return mixed
     *
     * @throws DecoratorException
     */
    public function decorate(?string $decorator = null);
}
