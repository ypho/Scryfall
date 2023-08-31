<?php

use Ypho\Scryfall\Client;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $client = new Client();
    $endpoint = $client->cards();

    foreach ($endpoint->allCardsInSet('v09') as $card) {
        echo sprintf('#%d: %s', $card->getCollectorNumber(), $card->getName()) . PHP_EOL;
    }
} catch (Throwable $throwable) {
    echo sprintf('Error found: %s', $throwable->getMessage());
}