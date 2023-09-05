<?php

use Ypho\Scryfall\Client;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $client = new Client();
    $endpoint = $client->sets();

    foreach ($endpoint->all() as $set) {
        echo sprintf('Set name: %s', $set->getName()) . PHP_EOL;
    }
} catch (Throwable $throwable) {
    echo sprintf('Error found: %s', $throwable->getMessage());
}