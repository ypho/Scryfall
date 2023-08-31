<?php

namespace Ypho\Scryfall\Endpoints;

use Throwable;
use Ypho\Scryfall\Client;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Objects\Set;

class SetEndpoint
{
    protected Client $client;

    function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns a Set object for the given set code (e.g. KTK) or by a UUID
     * from Scryfall (e.g. 2ec77b94-6d47-4891-a480-5d0b4e5c9372)
     *
     * @param string $code
     * @return Set
     * @throws ScryfallException
     */
    public function get(string $code): Set
    {
        try {
            $response = $this->client->fetchResponse('sets/' . $code);
            return Set::createFromApi($response);
        } catch (Throwable $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Returns an array with Set objects for ALL sets in existence. Please note
     * that this might be very memory intensive, so you should use caution when
     * calling this.
     *
     * @return array<Set>
     * @throws ScryfallException
     */
    public function all():array
    {
        try {
            $response = $this->client->fetchResponse('sets');

            $arrSets = [];
            foreach($response['data'] as $setData) {
                $arrSets[] = Set::createFromApi($setData);
            }

            return $arrSets;
        } catch (Throwable $throwable) {
            throw new ScryfallException($throwable->getMessage(), $throwable->getCode());
        }
    }
}