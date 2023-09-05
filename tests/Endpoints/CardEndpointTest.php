<?php

namespace Ypho\Scryfall\Tests\Endpoints;

use Ypho\Scryfall\Client;
use Ypho\Scryfall\Endpoints\CardEndpoint;
use PHPUnit\Framework\TestCase;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Objects\Card;

class CardEndpointTest extends TestCase
{
    protected $mockedClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockedClient = $this->createMock(Client::class);
    }

    /**
     * @throws ScryfallException
     */
    public function testGetSingleCard()
    {
        $cardApiResponse = file_get_contents(__DIR__ . '/../../examples/json/delver_of_secrets.json');

        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willReturn(json_decode($cardApiResponse, true));

        $cardEndpoint = new CardEndpoint($mockedClient);
        $card = $cardEndpoint->get('11bf83bb-c95b-4b4f-9a56-ce7a1816307a');

        $this->assertInstanceOf(Card::class, $card);
    }

    /**
     * @throws ScryfallException
     */
    public function testAllCardsInSet()
    {
        $ftvExiled = file_get_contents(__DIR__ . '/../../examples/json/cards_set_all_cards.json');

        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willReturn(json_decode($ftvExiled, true));

        $cardEndpoint = new CardEndpoint($mockedClient);
        $cards = $cardEndpoint->allCardsInSet('v09');

        $this->assertContainsOnlyInstancesOf(Card::class, $cards);
    }

    public function testAllCardsInSetMultiPage()
    {
        $cardListPage1 = file_get_contents(__DIR__ . '/../../examples/json/cards_search_multipage.json');
        $cardListPage2 = file_get_contents(__DIR__ . '/../../examples/json/cards_set_all_cards.json');

        $mockedClient = clone($this->mockedClient);
        $mockedClient
            ->expects($this->exactly(2))
            ->method('fetchResponse')
            ->willreturn(
                json_decode($cardListPage1, true),
                json_decode($cardListPage2, true)
            );


        $cardEndpoint = new CardEndpoint($mockedClient);
        $cards = $cardEndpoint->allCardsInSet('v09');

        $this->assertContainsOnlyInstancesOf(Card::class, $cards);
        $this->assertCount(4, $cards);
    }

    public function testExceptionOnInvalidCardId()
    {
        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willThrowException(new ScryfallException('Scryfall error'));

        $cardEndpoint = new CardEndpoint($mockedClient);

        $this->expectException(ScryfallException::class);
        $cardEndpoint->get('non-existing-id');
    }

    public function testExceptionOnAllCardsInSet()
    {
        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willThrowException(new ScryfallException('Scryfall error'));

        $cardEndpoint = new CardEndpoint($mockedClient);

        $this->expectException(ScryfallException::class);
        $cardEndpoint->allCardsInSet('invalid-set');
    }
}
