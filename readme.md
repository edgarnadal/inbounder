Inbounder
==

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/edgarnadal/inbounder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/edgarnadal/inbounder/?branch=master)

This is a laravel package for incoming webhook handling.

## Version
v0.1.0

## Documentation

Pending for documentation.

### Installation


### Requirements

- Laravel 5.1+

### Installing with Composer
1. In your **composer.json**, add the dependency: `"edgarnadal/inbounder": "dev-master"`

2. Add the Inbounder service provider in your config/app.php:
```php
        Inbounder\InbounderServiceProvider::class,
```

3. Add the following alias:
```php
        'Inbounder'    => Inbounder\Facades\Inbounder::class,
```

4. Create gateways:
```sh
php artisan vendor:publish --provider="Inbounder\InbounderServiceProvider"
```
Add your gateways like this on **config/inbounder.php**:
```php
    'gateways' => [
        'example-gateway' => 'App\\Example\InbounderHandler'
    ]
```

Coming soon more on creating handlers.

```php
post('/inbounder/{gateway}', function (\Request $request, $gateway) {

    $gateway = \Inbounder::gateway($gateway, $request);
    $parsed = $gateway->parse();

    dd($parsed);

    $handlerResponse = $parsed->handler()->run();

    // Do something with your handler response, in this case
    // I'll return it to the requester
    return response()->json($handlerResponse);

    // Or you could just return 200
    return response()->make();

});
```
