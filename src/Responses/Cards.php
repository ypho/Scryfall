<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;
use Ypho\Scryfall\Client;
use Ypho\Scryfall\ScryfallIterator;

/**
 * Class Cards
 * https://scryfall.com/docs/api/cards
 *
 * @package Scryfall\Responses
 */
class Cards extends Base implements \IteratorAggregate
{
    /** @var Card[] */
    protected $cards = [];

    /**
     * Expansions constructor.
     * @param Response $data
     */
    function __construct(Response $data)
    {
        parent::__construct($data);

        $response = json_decode($data->getBody()->getContents());

        if (!$this->hasError) {
            // Set some collection data
            $this->setCollectionData(count(@$response->data), @$response->total_cards, @$response->has_more);

            foreach ($response->data as $card) {
                $this->cards[] = new Card($card, false);
            }
        }
    }

    /**
     * @return ScryfallIterator|\Traversable
     */
    public function getIterator()
    {
        return new ScryfallIterator($this->cards);
    }

    /**
     * @return Card[]
     */
    public function cards()
    {
        return $this->cards;
    }
}