# LaraPay

This class makes it more easy to integrate the payment provider *Pay.nl* into your website.

## Requirements
- Laravel 5.x
- Pay.nl account

## Installation

Require this package by doing:

`composer require cannonb4ll/larapay`

After installing, register the service provider inside `config/app.php`:

`LaraPay\ServiceProvider::class,`

Now you can publish the configuration file with the following command:

`php artisan vendor:publish --provider="LaraPay\ServiceProvider"`

After this you have to setup 2 variables inside your `.env` file:

```
PAY_TOKEN=
PAY_SERVICE_ID=
```

You can get these credentials fromout https://admin.pay.nl