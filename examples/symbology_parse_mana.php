<?php

use Ypho\Scryfall\Client;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $client = new Client();
    $endpoint = $client->symbology();

    $writtenManaCost = '3UW';
    $manaCost = $endpoint->parseMana($writtenManaCost);

    echo sprintf('Mana cost %s converts to: %s', $writtenManaCost, $manaCost->getCost()) . PHP_EOL;
} catch (Throwable $throwable) {
    echo sprintf('Error found: %s', $throwable->getMessage());
}
