<?php

namespace mindtwo\LaravelDecorator;

use ArrayAccess;
use mindtwo\LaravelDecorator\Exceptions\DecoratorException;
use ReflectionMethod;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class ArrayDecorator implements ArrayAccess
{
    /**
     * @var array
     */
    protected $data;

    /**
     * MiteEntryDecorator constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * ArrayAccess set.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * ArrayAccess unset.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * ArrayAccess exists.
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * ArrayAccess get.
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Determinates if a string represents a valid mutator method.
     *
     * @param string $method
     *
     * @throws \ReflectionException
     *
     * @return bool
     */
    protected function isMutatorMethod(string $method): bool
    {
        if (! method_exists($this, $method)) {
            return false;
        }

        $reflection = new ReflectionMethod($this, $method);
        if (! $reflection->isPublic()) {
            return false;
        }

        return true;
    }

    /**
     * Magic getter.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $method = Str::camel($name);

        if ($this->isMutatorMethod($method)) {
            return $this->$method();
        }

        return $this->data[$name] ?? null;
    }

    /**
     * Static make method.
     *
     * @param array $data
     *
     * @return self
     */
    public static function make(array $data)
    {
        return new static($data);
    }

    /**
     * Create a decorated collection.
     *
     * @param array|Collection $data
     *
     * @return Collection
     */
    public static function makeCollection($data): Collection
    {
        if (! is_array($data) && ! is_a($data, Collection::class)) {
            throw new DecoratorException('Datatype must be array or Collection');
        }

        return Collection::make($data)->map(function ($item) {
            return static::make($item);
        });
    }
}