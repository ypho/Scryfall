<?php

use Ypho\Scryfall\Client;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $client = new Client();
    $endpoint = $client->symbology();

    foreach ($endpoint->all() as $symbol) {
        echo sprintf('Symbol: %s', $symbol->getSymbol()) . PHP_EOL;
    }
} catch (Throwable $throwable) {
    echo sprintf('Error found: %s', $throwable->getMessage());
}
