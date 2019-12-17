<?php

namespace mindtwo\LaravelDecorator\Traits;

use mindtwo\LaravelDecorator\Exceptions\DecoratorException;

trait HasDecorator
{
    /**
     * Get the default decorator class path.
     *
     * @return string|null
     */
    public function getDefaultDecorator(): ?string
    {
        if (method_exists($this, 'defaultDecorator')) {
            return $this->defaultDecorator();
        }

        return $this->default_decorator ?? null;
    }

    /**
     * Determinate if the model use a default decorator.
     *
     * @return bool
     */
    public function hasDefaultDecorator(): bool
    {
        return (bool) $this->getDefaultDecorator();
    }

    /**
     * Decorate the model.
     *
     * @param string|null $decorator
     *
     * @throws DecoratorException
     *
     * @return mixed
     */
    public function decorate(?string $decorator = null)
    {
        $decorator = ! empty($decorator) ? $decorator : $this->getDefaultDecorator();

        if (! class_exists($decorator)) {
            throw new DecoratorException('Decorator class not found');
        }

        return $decorator::decorate($this);
    }
}
