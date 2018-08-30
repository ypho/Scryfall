<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;
use Traversable;
use Ypho\Scryfall\Responses\Symbol;
use Ypho\Scryfall\ScryfallIterator;

/**
 * Class Sets
 * https://scryfall.com/docs/api/card-symbols/all
 *
 * @package Scryfall\Responses
 */
class Symbols extends Base implements \IteratorAggregate
{
    /** @var Symbol[] */
    protected $symbols = [];

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
            $this->setCollectionData(count(@$response->data), count(@$response->data), @$response->has_more);

            foreach ($response->data as $symbol) {
                $this->symbols[] = new Symbol($symbol, false);
            }
        }
    }

    /**
     * @return Traversable|ScryfallIterator
     */
    public function getIterator()
    {
        return new ScryfallIterator($this->symbols);
    }

    /**
     * @return Symbol[]
     */
    public function symbols()
    {
        return $this->symbols;
    }
}