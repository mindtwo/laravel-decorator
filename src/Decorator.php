<?php

namespace mindtwo\LaravelDecorator;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class Decorator
{
    /**
     * The model which will be decorated.
     *
     * @var Model
     */
    protected $model;

    /**
     * Presenter constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * Magic call method.
     *
     * @param string     $method
     * @param array|null $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
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

        return $this->model->$name;
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

        $reflection = new \ReflectionMethod($this, $method);
        if (! $reflection->isPublic()) {
            return false;
        }

        return true;
    }

    /**
     * Decorates a model or a collection of models.
     *
     * @param Model|Collection $data
     *
     * @return Decorator|Collection
     */
    public static function decorate($data)
    {
        if (is_object($data) && is_a($data, Model::class)) {
            return new static($data);
        }

        return Collection::make($data)->decorate(static::class);
    }
}
