<?php

namespace Ypho\Scryfall\Endpoints;

use Throwable;
use Ypho\Scryfall\Client;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Objects\Card;

class CardEndpoint
{
    protected Client $client;

    function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns a single Card based on the Scryfall UUID.
     *
     * @param string $uuid
     * @return Card
     * @throws ScryfallException
     */
    public function get(string $uuid): Card
    {
        try {
            $response = $this->client->fetchResponse('cards/' . $uuid);
            return Card::createFromApi($response);
        } catch (Throwable $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Returns all Card objects for a given Set code (e.g. "KTK").
     *
     * @param string $setCode
     * @return array<Card>
     * @throws ScryfallException
     */
    public function allCardsInSet(string $setCode): array
    {
        try {
            $response = $this->client->fetchResponse('cards/search', 'GET', [
                'include_extras' => true,
                'include_variations' => true,
                'order' => 'set',
                'q' => 'e:' . $setCode,
                'unique' => 'prints',
            ]);

            // Set the first set of cards
            $cards = $response['data'];

            // Check if we have more cards
            $hasMore = $response['has_more'];
            while($hasMore === true) {
                // Fetch all next pages
                $nextPage = $this->client->fetchResponse($response['next_page']);
                $hasMore = $nextPage['has_more'];

                // Push new cards to the array of cards
                array_push($cards, ...$nextPage['data']);
            }

            $arrCards = [];
            foreach($cards as $card) {
                $arrCards[] = Card::createFromApi($card);
            }

            return $arrCards;
        } catch (Throwable $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }
}