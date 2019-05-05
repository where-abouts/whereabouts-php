# Whereabouts-PHP

Official PHP client for [Whereabouts](https://whereabouts.blue).

## Requirements

* PHP 5.6 or higher

## Installation

The preferred method of installation is with [Composer](http://getcomposer.org/). Run the following command or add `"whereabouts/whereabouts-php": "~1.0"` to your `composer.json` file manually.

```bash
composer require whereabouts/whereabouts-php
```

## Usage

To find an address, you can use the `findAddress`-method. This method expects at least a country code and postal code.

```php

use Whereabouts\Client;

$client = new Client('YOUR_API_KEY_HERE');

# Find address based on just a country- and postal code.
$result = $client->findAddress('NL', '1011AB'); # Returns a Whereabouts\Model\AddressResult object

```