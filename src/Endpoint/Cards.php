<?php

namespace Ypho\Scryfall\Endpoint;

use Ypho\Scryfall\Client;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Responses\Card;
use Ypho\Scryfall\Responses\Rulings;

class Cards
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
     * @param int $page
     * @return \Ypho\Scryfall\Responses\Cards
     * @throws ScryfallException
     */
    public function all($page = 1)
    {
        try {
            $response = $this->client->send('GET', 'cards?page=' . (int)$page);
            $cards = new \Ypho\Scryfall\Responses\Cards($response);
            return $cards;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param $id
     * @return Card
     * @throws ScryfallException
     */
    public function get($id)
    {
        try {
            $response = $this->client->send('GET', 'cards/' . $id);
            $card = new Card($response);
            return $card;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param $query
     * @param string $unique
     * @param string $order
     * @param string $dir
     * @param bool $extras
     * @param bool $multilang
     * @param int $page
     * @return \Ypho\Scryfall\Responses\Cards
     * @throws ScryfallException
     */
    public function search($query, $unique='cards', $order='name', $dir='auto', $extras=false, $multilang=false, $page=1)
    {
        try {
            // Build string
            $queryString = '?q=' . $query;
            $queryString.= '&unique=' . $unique;
            $queryString.= '&order=' . $order;
            $queryString.= '&dir=' . $dir;
            $queryString.= '&include_extras=' . $extras;
            $queryString.= '&include_multilingual=' . $multilang;
            $queryString.= '&page=' . $page;

            $response = $this->client->send('GET', 'cards/search' . $queryString);
            $cards = new \Ypho\Scryfall\Responses\Cards($response);
            return $cards;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param $id
     * @param null $type
     * @return Rulings
     * @throws ScryfallException
     */
    public function rulings($id, $type=null)
    {
        $url = 'cards/';

        if(!is_null($type)) {
            $url .= $type . '/';
        }

        try {
            $response = $this->client->send('GET', $url . $id . '/rulings');
            $rulings = new Rulings($response);
            return $rulings;
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }
}