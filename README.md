# Laravel Proxicore Package

This is package can be used by Laravel Application that want to connect
to Proxicore as client.

### Version Support

| Proxicore         | PHP       | Laravel   |
|:------------------|:----------|:----------|
| 0.0.0.1 - 0.0.3.7 | 7.0 - 7.4 | 5.4 - 8.0 |
| 1.0+              | 7.4 - 8.0 | 8.12+     |

## Installation

Since this is a private package and is not published on packagist,
therefore you need to add the repository to your application's
`composer.json` file first:

```json
{
  "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:rebelwalls/laravel-proxicore.git"
        }
    ]
}
```

After it has been added, run in the application's root folder:

```bash
composer require rebelwalls/laravel-proxicore
```

### Configuration

Set the values in your app's `.env` file:

```dotenv
PROXICORE_ENDPOINT=https://test.proxicore.com/
PROXICORE_ORIGIN=cronos
```

Alternatively, you can publish the package configuration to your app,
by running:

```bash
php artisan vendor:publish --provider='RebelWalls\LaravelProxicore\ServiceProvider'
```

It will create the default config file in the `config/laravel-proxicore.php`
folder.

```
return [
    'origin' => env('PROXICORE_ORIGIN'),
    'endpoint' => env('PROXICORE_ENDPOINT')
];