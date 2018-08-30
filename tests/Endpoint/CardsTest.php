<?php

namespace Tests\Endpoint;

use Tests\TestCase;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Responses\Card;
use Ypho\Scryfall\Responses\CardFace;
use Ypho\Scryfall\Responses\Cards;

class CardsTest extends TestCase
{
    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testAllCards()
    {
        $client = $this->getMockedClient('cards/all.json');
        $cards = $client->cards()->all(1);

        $this->assertInstanceOf(Cards::class, $cards);
        $this->assertContainsOnlyInstancesOf(Card::class, $cards->getIterator());
    }

    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testGetSaheeliTheGifted()
    {
        $client = $this->getMockedClient('cards/saheeli_the_gifted.json');
        $card = $client->cards()->get('b32b3dae-7616-46ad-b9bf-854559cda977');

        $this->assertEquals('normal', $card->layout);
        $this->assertEquals('4', $card->loyalty);
        $this->assertEquals(true, $card->isOversized);
        $this->assertEquals(false, $card->isNonFoil);
        $this->assertInstanceOf(Card::class, $card);
    }

    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testGetDelverOfSecrets()
    {
        $client = $this->getMockedClient('cards/delver_of_secrets.json');
        $card = $client->cards()->get('11bf83bb-c95b-4b4f-9a56-ce7a1816307a');

        $this->assertEquals('transform', $card->layout);
        $this->assertInstanceOf(Card::class, $card);
        $this->assertContainsOnlyInstancesOf(CardFace::class, $card->getFaces());
    }

    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testGetGrafRats()
    {
        $client = $this->getMockedClient('cards/graf_rats.json');
        $card = $client->cards()->get('3dedaff6-bd69-4fe3-a301-f7ea7c2f2861');

        $this->assertEquals('meld', $card->layout);
        $this->assertInstanceOf(Card::class, $card);
        $this->assertContainsOnlyInstancesOf(\stdClass::class, $card->getRelated());
    }

    /**
     * @throws ScryfallException
     */
    public function testSearchDefault()
    {
        $client = $this->getMockedClient('cards/search_default.json');
        $cards = $client->cards()->search('pacifism');

        $this->assertInstanceOf(Cards::class, $cards);
        $this->assertequals(1, $cards->total());
        $this->assertContainsOnlyInstancesOf(Card::class, $cards->getIterator());
    }

    /**
     * @throws ScryfallException
     */
    public function testSearchUniqueArts()
    {
        $client = $this->getMockedClient('cards/search_unique_art.json');
        $cards = $client->cards()->search('lightning helix', 'art');

        $this->assertInstanceOf(Cards::class, $cards);
        $this->assertequals(3, $cards->total());
        $this->assertContainsOnlyInstancesOf(Card::class, $cards->getIterator());
    }

    /**
     * @throws ScryfallException
     */
    public function testSearchNoResults()
    {
        $client = $this->getMockedClient('cards/search_no_results.json', 404);

        $this->expectException(ScryfallException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('Your query didn’t match any cards. Adjust your search terms or refer to the syntax guide at https://scryfall.com/docs/reference');

        $client->cards()->search('non existing card');
    }
}