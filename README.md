# Laravel Decorator
[![Build Status](https://travis-ci.org/mindtwo/laravel-decorator.svg?branch=master)](https://travis-ci.org/mindtwo/laravel-decorator)
[![StyleCI](https://styleci.io/repos/228616529/shield)](https://styleci.io/repos/159368194)
[![Quality Score](https://img.shields.io/scrutinizer/g/mindtwo/laravel-decorator.svg?style=flat-square)](https://scrutinizer-ci.com/g/mindtwo/laravel-decorator)
[![Latest Stable Version](https://img.shields.io/packagist/v/mindtwo/laravel-decorator?style=flat-square)](https://packagist.org/packages/mindtwo/laravel-decorator)
[![Total Downloads](https://img.shields.io/packagist/dt/mindtwo/laravel-decorator?style=flat-square)](https://packagist.org/packages/mindtwo/laravel-decorator)
[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

## Installation

You can install the package via composer:

```bash
composer require mindtwo/laravel-decorator
```

## How to use?

### Preparing the Eloquent Model

To use a decorator the underlaying eloquent model must implement the `Decoratable` interface. 
Farther you should use the `HasDecorator` trait, which implements the required methods.

```php
use Illuminate\Database\Eloquent\Model;
use mindtwo\LaravelDecorator\Interfaces\Decoratable;
use mindtwo\LaravelDecorator\Traits\HasDecorator;

class MyModel extends Model implements Decoratable
{
    use HasDecorator;
}
```

You can optionally setup a default decorator on the eloquent model, 
which will be used when you call the `decorate()` method without any params.

```php
use Illuminate\Database\Eloquent\Model;
use mindtwo\LaravelDecorator\Interfaces\Decoratable;
use mindtwo\LaravelDecorator\Traits\HasDecorator;

class MyModel extends Model implements Decoratable
{
    use HasDecorator;

    /**
     * Return the default decorator full qualified class name.
     *
     * @return string
     */
    public function defaultDecorator(): string
    {
        return MyDecorator::class;
    }
}
```

### Writing a Decorator

To write a decorator simply extend the basic decorator class. 
You can access the undelaying eloquent model by the `$this->model` property. 
Whenever you try to access a property on the decorator, it will first look for 
a function with the camilzed property name. If it is defined, it will be called,
otherwise it will be forwarded to the underlaying eloquent model.  

```php
use mindtwo\LaravelDecorator\Decorator;

class MyDecorator extends Decorator
{
    /**
     * Get formatted creation date.
     *
     * @return string
     */
    public function defaultDecorator(): string
    {
        return $this->model->created_at->format('Y-m-d');
    }
}
```

### Using a Decorator

To use a decorator simply call the `decorate()` method on the model. 
You can use the full qualified class name of a decorator class as parameter to
specify a decorator, otherwise the default decorator will be used.

```php
$myObject = MyModel::make();

// Use a certain decorator
$myDecoratedObject = $myObject->decorate(MyDecorator::class);

// Use the default decorator (needs to be defined on the model)
$myDecoratedObject = $myObject->decorate();
```

It is also possible to call the 'decorate()' method on collections, cause
the package autmatically registers it as a macro.

```php
$myCollection = MyModel::get();

// Use a certain decorator
$myDecoratedCollection = $myCollection->decorate(MyDecorator::class);

// Use the default decorator (needs to be defined on the model)
$myDecoratedCollection = $myCollection->decorate();
```

Note that all items in the collection must implement the `Decoratable` interface, 
otherwise this will throw an exception. 


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email info@mindtwo.de instead of using the issue tracker.

## Credits

- [mindtwo GmbH](https://github.com/mindtwo)
- [All Other Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
 
