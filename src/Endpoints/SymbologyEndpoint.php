<?php

namespace Ypho\Scryfall\Endpoints;

use Throwable;
use Ypho\Scryfall\Client;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Objects\ManaCost;
use Ypho\Scryfall\Objects\Symbol;

class SymbologyEndpoint
{
    protected Client $client;

    function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns an array with Set objects for ALL symbols in existence. Please note
     * that this might be very memory intensive, so you should use caution when
     * calling this.
     *
     * @return array<Symbol>
     * @throws ScryfallException
     */
    public function all(): array
    {
        try {
            $response = $this->client->fetchResponse('symbology');

            $arrSymbols = [];
            foreach ($response['data'] as $setData) {
                $arrSymbols[] = Symbol::createFromApi($setData);
            }

            return $arrSymbols;
        } catch (Throwable $throwable) {
            throw new ScryfallException($throwable->getMessage(), $throwable->getCode());
        }
    }

    /**
     * Converts a textual mana cost to symbols, for example "UW3".
     *
     * @param string $mana
     * @return ManaCost
     * @throws ScryfallException
     */
    public function parseMana(string $mana): ManaCost
    {
        try {
            $response = $this->client->fetchResponse('symbology/parse-mana', 'GET', ['cost' => $mana]);
            return ManaCost::createFromApi($response);
        } catch (Throwable $throwable) {
            throw new ScryfallException($throwable->getMessage(), $throwable->getCode());
        }
    }
}