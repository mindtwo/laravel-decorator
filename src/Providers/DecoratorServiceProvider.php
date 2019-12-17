<?php

namespace mindtwo\LaravelDecorator\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use mindtwo\LaravelDecorator\Exceptions\DecoratorException;
use mindtwo\LaravelDecorator\Interfaces\Decoratable;

class DecoratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Collection::macro('decorate', function ($class = '') {
            return $this->map(function ($model) use ($class) {

                if (! is_a($model, Decoratable::class)) {
                    throw new DecoratorException('Model is not decoratable');
                }

                return $model->decorate($class);
            });
        });
    }
}
