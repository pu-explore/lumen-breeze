<p align="center"><img src="/art/logo.svg" alt="Logo Laravel Breeze"></p>

<p align="center">
    <a href="https://packagist.org/packages/laravel/breeze">
        <img src="https://img.shields.io/packagist/dt/laravel/breeze" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/breeze">
        <img src="https://img.shields.io/packagist/v/laravel/breeze" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/breeze">
        <img src="https://img.shields.io/packagist/l/laravel/breeze" alt="License">
    </a>
</p>

## Installation Package

```shell
composer require laravel/lumen-breeze --dev
```

## In `bootstrap/app.php` Add Service

```shell
//$app->register(App\Providers\AppServiceProvider::class);
//$app->register(App\Providers\AuthServiceProvider::class);
//$app->register(App\Providers\EventServiceProvider::class);
$app->register(\Lumen\Breeze\BreezeServiceProvider::class);
```

## Start Installation

```shell
php artisan breeze:install

php artisan migrate

npm install && npm run dev
```

## Configure mail parameters in the `.env` file

```shell
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

## Introduction

Breeze provides a minimal and simple starting point for building a Laravel application with authentication. Styled with Tailwind, Breeze publishes authentication controllers and views to your application that can be easily customized based on your own application's needs.

Laravel Breeze is powered by Blade and Tailwind. If you're looking for a more robust Laravel starter kit that includes two factor authentication, Livewire / Inertia support, and more, check out [Laravel Jetstream](https://jetstream.laravel.com).

## Official Documentation

Documentation for Breeze can be found on the [Laravel website](https://laravel.com/docs/8.x/starter-kits#laravel-breeze).

## Contributing

Thank you for considering contributing to Breeze! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

Please review [our security policy](https://github.com/laravel/breeze/security/policy) on how to report security vulnerabilities.

## License

Laravel Breeze is open-sourced software licensed under the [MIT license](LICENSE.md).
