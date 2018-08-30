<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;
use Ypho\Scryfall\ScryfallIterator;

/**
 * Class Sets
 * https://scryfall.com/docs/api/sets
 *
 * @package Scryfall\Responses
 */
class Sets extends Base implements \IteratorAggregate
{
    /** @var Set[] */
    protected $sets = [];

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

            foreach ($response->data as $set) {
                $this->sets[] = new Set($set, false);
            }
        }
    }

    /**
     * @return ScryfallIterator|\Traversable
     */
    public function getIterator()
    {
        return new ScryfallIterator($this->sets);
    }

    /**
     * @return Set[]
     */
    public function sets()
    {
        return $this->sets;
    }
}