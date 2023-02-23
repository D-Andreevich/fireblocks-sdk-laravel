# Getting started with Laravel

The Laravel SDK for Fireblocks API

[![Current version](https://img.shields.io/packagist/v/d-andreevich/fireblocks-sdk-laravel.svg?logo=composer)](https://packagist.org/packages/d-andreevich/fireblocks-sdk-laravel)
[![Monthly Downloads](https://img.shields.io/packagist/dm/d-andreevich/fireblocks-sdk-laravel.svg)](https://packagist.org/packages/d-andreevich/fireblocks-sdk-laravel/stats)
[![Total Downloads](https://img.shields.io/packagist/dt/d-andreevich/fireblocks-sdk-laravel.svg)](https://packagist.org/packages/d-andreevich/fireblocks-sdk-laravel/stats)

## Basics
This repository contains the Laravel SDK for Fireblocks API.
For the complete API reference, go to the [API reference](https://docs.fireblocks.com/api).


### Requirements
PHP 7.2 or newer.

## Installation

You can install the Provider as a composer package.

```bash
composer require d-andreevich/fireblocks-sdk-laravel
```

### Publish config
For further configuration, please see config/fireblocks.php. You can modify the configuration by copying it to your local config directory or by defining the environment variables used in the config file.

Publish `fireblocks.php` config
```
php artisan vendor:publish --provider="FireblocksSdkLaravel\FireblocksServiceProvider" --tag=config
```

## Set up your .env file configuration

You can set the default configuration in your .env file of you Laravel project.

```text
FIREBLOCKS_PRIVATE_KEY_PATH=path/file_name.key
FIREBLOCKS_API_KEY=api_key
FIREBLOCKS_API_BASE_URL=https://api.fireblocks.io
FIREBLOCKS_TIMEOUT=10
FIREBLOCKS_API_PUBLIC_KEY_PATH='path/webhook_sig.pub'
FIREBLOCKS_X_WEBHOOK_SECRET='secret'
```
## Usage
### Before You Begin
Make sure you have the credentials for Fireblocks API Services. Otherwise, please contact Fireblocks support for further instructions on how to obtain your API credentials.

### Start
Once you have retrieved a component, please refer to the [documentation of the Fireblocks](https://docs.fireblocks.com/api/?python#introduction)
for further information on how to use it.

**You don't need and should not use the `new FireblocksSDK()` pattern described in the SDK documentation, this is already
done for you with the Laravel Service Provider. Use Dependency Injection, the Facades or the `app()` helper instead**

```php
use FireblocksSDK;

$result = FireblocksSDK::get_gas_station_info();
```

You can use the Python examples from the [documentation of the Fireblocks](https://docs.fireblocks.com/api/?python#introduction), all methods have the same names, all functionality is duplicated from [fireblocks-sdk-py](https://github.com/fireblocks/fireblocks-sdk-py).


### WebHook types and middleware
Also, you can use the event types ```\FireblocksSdkLaravel\Types\WebHook\Events```
```php
Route::post('/fireblocks/webhook/events', function (\Illuminate\Http\Request $req) {

    $object = \FireblocksSdkLaravel\Types\WebHook\Events\FactoryEvent::get(...$req->all());

    return response()->json((array)$object);
})->middleware([\FireblocksSdkLaravel\Http\Middlewares\EventMiddleware::class]);
```
or notification type ```\FireblocksSdkLaravel\Types\WebHook\Notifications```
```php
Route::post('/fireblocks/webhook/notifications', function (\Illuminate\Http\Request $req) {

    $object = new \FireblocksSdkLaravel\Types\WebHook\Notifications\Notification(...$req->all());

    return response()->json((array)$object);
})->middleware([\FireblocksSdkLaravel\Http\Middlewares\NotificationMiddleware::class]);
```
Please note that you can use middleware ```\FireblocksSdkLaravel\Http\Middlewares``` in your project.