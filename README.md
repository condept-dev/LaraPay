# LaraPay

This class makes it more easy to integrate the payment provider *Pay.nl* into your website.

## Requirements
- Laravel 5.x
- Pay.nl account
- Pay.nl package (composer: *composer require paynl/sdk*, https://github.com/paynl/sdk)

## Installation

Add Pay.php to a folder inside this folder: *app\Utilities\Pay.php*

## To make it even more easier....
Add the helpers.php file to the *app\Utilities* folder aswell. Then in your composer add it to the autoload:

```
  "autoload": {
    "classmap": [
      "database"
    ],
    "files": [
      "app/Utilities/helpers.php"
    ],
    "psr-4": {
      "App\\": "app/"
    }
  },
```

Commands:

```
// ## Get all payment methods, returns a collection
pay()->methods();
```

```
// ## Get the method name by method id
pay()->methodName($id);
```

```
// ## Get all banks (for iDEAL)
pay()->banks();
```


## Starting a payment:

```
pay()->startTransaction([
    'amount' => $total,
    'returnUrl' => 'http://www.example.com/thanks',

    'exchangeUrl' => 'http://www.example.com/webhook',
    'paymentMethod' => 138,,
    'description' => 'ORder',
    'testmode' => 1
]);
```

## Getting a payment

```
pay()->getTransaction($id);
```

## Todo

- Add chargeback functionality
- Expand class more wisely