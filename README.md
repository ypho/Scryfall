# Scryfall Api Wrapper
This wrapper connects with the Scryfall API.

## Installation
You can use composer to require the package, it will automatically install.
> composer require ypho/scryfall ^1.0

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
// Fetches all sets
$collSets = $client->sets()->all();
$arrSets = $collSets->sets();
 
// Get only Mercadian Masques
$mmq = $client->sets()->get('mmq');
```

### Cards
```php
// Fetches all cards, first page
$collCards = $client->cards()->all(1);
$collCards->total(); // Total amount of cards available
$collCards->count(); // Total amount of cards on this page
$collCards->hasMore(); // Boolean if there are more pages
$collCards->cards(); // Array with Card objects
 
// Get only the Card object for Delver of Secrets
$delver = $client->cards()->get('11bf83bb-c95b-4b4f-9a56-ce7a1816307a');
 
// Searches for unique cards with 'pacifism' in the name,
$collCards = $client->cards()->search('pacifism');
$arrPacifism = $collCards->cards();
 
// Searches for unique arts with 'lightning helix' in the name
$collCards = $client->cards()->search('lightning helix', 'art');
$arrHelix = $collCards->cards();
 
// Searches for all versions of 'arbor elf', ordered by release date, newest first
$collCards = $client->cards()->search('arbor elf', 'prints', 'released', 'desc');
$arrElves = $collCards->cards(); 
 
// Finds the rulings for Geist of Saint Traft
$collRulings = $client->cards()->rulings('0ba5dd1a-6906-4b45-bbf7-2f10cb955083');
$arrRulings = $collRulings->rulings();
 
// Finds the rulings for Geist of Saint Traft, but by MTGO ID
$collRulings = $client->cards()->rulings(42824, 'mtgo');
$arrRulings = $collRulings->rulings();
```

### Symbols
```php
// Get all MTG Symbols
$collSymbols = $client->symbols()->all();
$arrSymbols = $collSymbols->symbols();
 
// Parse your string to symbols
$parsed = $client->symbols()->parse('RGx'); // Returns {X}{R}{G}
```