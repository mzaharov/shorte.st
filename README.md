# Laravel Shorte.st

[![Latest Stable Version](https://poser.pugx.org/appsketch/shortest/v/stable)](https://packagist.org/packages/appsketch/shortest) [![Total Downloads](https://poser.pugx.org/appsketch/shortest/downloads)](https://packagist.org/packages/appsketch/shortest) [![Latest Unstable Version](https://poser.pugx.org/appsketch/shortest/v/unstable)](https://packagist.org/packages/appsketch/shortest) [![License](https://poser.pugx.org/appsketch/shortest/license)](https://packagist.org/packages/appsketch/shortest)

## Installation

First, pull in the package through Composer.

```js
composer require appsketch/shortest
```

And then, if using Laravel 5.1, include the service provider within `app/config/app.php`.

```php
'providers' => [
    Appsketch\Shortest\Providers\ShortestServiceProvider::class,
]
```

if using Laravel 5. include this service provider.

```php
'providers' => [
    "Appsketch\Shortest\Providers\ShortestServiceProvider",
]
```

The alias will automatically set.

Publish the config file to the config folder with the following command.
`php artisan vendor:publish`.

Fill out the config file.

## Usage

Within, for example the routes.php add this.

```php
Route::get('/shortest', function()
{
    // this will for example echo http://sh.st/v0v8m.
    echo Shortest::link("http://www.google.com/");
});
```