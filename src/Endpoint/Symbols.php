<?php

namespace Ypho\Scryfall\Endpoint;

use Ypho\Scryfall\Client;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Responses\ParsedMana;

class Symbols
{
    /** @var Client */
    protected $client;

    /**
     * Account constructor.
     * @param $client
     */
    function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @return \Ypho\Scryfall\Responses\Symbols
     * @throws ScryfallException
     */
    function all()
    {
        try {
            $response = $this->client->send('GET', 'symbology');
            $symbols = new \Ypho\Scryfall\Responses\Symbols($response);
            return $symbols;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param $cost
     * @return ParsedMana
     * @throws ScryfallException
     */
    function parse($cost)
    {
        try {
            $response = $this->client->send('GET', 'symbology/parse-mana?cost=' . $cost);
            $mana = new ParsedMana($response);
            return $mana;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }
}