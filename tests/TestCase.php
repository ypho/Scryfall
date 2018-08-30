<?php

namespace Tests;

use Tests\TestSupport\HandlerFactory;
use Ypho\Scryfall\Client;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param string $method
     * @param int $statusCode
     * @return Client
     */
    protected function getMockedClient(string $method, int $statusCode = 200)
    {
        $handler = HandlerFactory::getHandler($method, $statusCode);

        $httpClient = new \GuzzleHttp\Client([
            'handler' => $handler,
            'base_uri' => 'https://api.scryfall.com/',
        ]);

        $client = new Client($httpClient);

        return $client;
    }
}