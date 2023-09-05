# Scryfall Api Wrapper
This wrapper connects with the Scryfall API.

## Installation
You can use composer to require the package, it will automatically install the latest version.
> composer require ypho/scryfall

### Testing the package
In this package there are several tests. The responses are mocked, so it won't actually spam the Scryfall API.
> vendor/bin/phpunit

## How to use the package
In the examples folder, there are some example scripts you can use. Otherwise, you can use the snippets below.
### Initialize new client
```php
require 'vendor/autoload.php';
$client = new Ypho\Scryfall\Client();
```
### Sets

```php
// Get the Endpoint
$setEndpoint = $client->sets();

$setEndpoint->all(); // Returns an array with Set-objects
$setEndpoint->get('mmq'); // Returns a single Set-object of the Mercadian Masques set 
```

### Cards
```php
$cardEndpoint = $client->cards();

$cardEndpoint->get('0038ea4d-d0a6-44a4-bee6-24c03313d2bc'); // Returns a Card-object of Sphinx's Revelation (MM3 version)
$cardEndpoint->allCardsInSet('mm3'); // Returns an array with Card-objects for all cards in MM3
```

### Symbols
```php
$symbologyEndpoint = $client->symbology();

$symbologyEndpoint->all(); // Returns an array with all Symbol-objects
$symbologyEndpoint->parseMana('RG'); // Returns a ManaCost-object
```