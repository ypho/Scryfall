# Scryfall Api Wrapper
This wrapper connects with the Scryfall API.

## Installation
You can use composer to require the package, it will automatically install.
> composer require ypho/scryfall

### Testing the package
In this package there are several tests. The responses are mocked, so it won't actually spam the Scryfall API.
> vendor/bin/phpunit

## How to use the package
### Initialize new client
```php
include 'vendor/autoload.php';
$client = new Ypho\Scryfall\Client();
```
### Sets

```php
// Get the Endpoint
$setEndpoint = $client->sets();

$setEndpoint->all(); // Fetches all sets
$setEndpoint->get('mmq'); // Get only Mercadian Masques
```

### Cards
```php
$cardEndpoint = $client->cards();
$cardEndpoint->get('0038ea4d-d0a6-44a4-bee6-24c03313d2bc'); // Fetch Sphinx's Revelation from MM3
$cardEndpoint->allCardsInSet('mm3'); // Fetch all cards from MM3
```

### Symbols
```php
$symbologyEndpoint = $client->symbology();

$symbologyEndpoint->all(); // Fetch all Symbols and their information
$symbologyEndpoint->parseMana('RG'); // Convert to "{R}{G}"
```