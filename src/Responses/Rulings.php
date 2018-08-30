<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;
use Ypho\Scryfall\ScryfallIterator;

/**
 * Class Rulings
 * https://scryfall.com/docs/api/rulings
 *
 * @package Scryfall\Responses
 */
class Rulings extends Base implements \IteratorAggregate
{
    /** @var Ruling[] */
    protected $rulings = [];

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

            foreach ($response->data as $ruling) {
                $this->rulings[] = new Ruling($ruling, false);
            }
        }

        return $this->getIterator();
    }

    /**
     * @return ScryfallIterator|\Traversable
     */
    public function getIterator()
    {
        return new ScryfallIterator($this->rulings);
    }

    /**
     * @return Ruling[]
     */
    public function rulings()
    {
        return $this->rulings;
    }
}