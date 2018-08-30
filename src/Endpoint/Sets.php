<?php

namespace Ypho\Scryfall\Endpoint;

use Ypho\Scryfall\Client;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Responses\Set;

class Sets
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
     * @return \Ypho\Scryfall\Responses\Sets
     * @throws ScryfallException
     */
    public function all()
    {
        try {
            $response = $this->client->send('GET', 'sets');
            $sets = new \Ypho\Scryfall\Responses\Sets($response);
            return $sets;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param $code
     * @return Set
     * @throws ScryfallException
     */
    public function get($code)
    {
        try {
            $response = $this->client->send('GET', 'sets/' . $code);
            $set = new Set($response);
            return $set;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }
}