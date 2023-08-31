<?php

use Ypho\Scryfall\Client;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $client = new Client();
    $endpoint = $client->sets();

    // Fetch a set by CODE
    $set = $endpoint->get('mmq');
    echo sprintf('Set ID: %s', $set->getId()) .PHP_EOL;
    echo sprintf('Set name: %s', $set->getName()) .PHP_EOL;

    // Fetch a set by UUID
    $set2 = $endpoint->get('2ec77b94-6d47-4891-a480-5d0b4e5c9372');
    echo sprintf('Set ID: %s', $set2->getId()) .PHP_EOL;
    echo sprintf('Set name: %s', $set2->getName()) .PHP_EOL;
} catch (Throwable $throwable) {
    echo sprintf('Error found: %s', $throwable->getMessage());
}