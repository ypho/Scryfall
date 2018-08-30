<?php

namespace Tests\Endpoint;

use Tests\TestCase;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Responses\Set;
use Ypho\Scryfall\Responses\Sets;

class SetsTest extends TestCase
{
    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testGetAllSets()
    {
        $client = $this->getMockedClient('sets/all.json');
        $sets = $client->sets()->all();
        $this->assertInstanceOf(Sets::class, $sets);
        $this->assertContainsOnlyInstancesOf(Set::class, $sets->getIterator());
    }

    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testGetSingleSet()
    {
        $client = $this->getMockedClient('sets/single_set.json');
        $set = $client->sets()->get('avr');
        $this->assertInstanceOf(Set::class, $set);
    }

    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testGetInvalidSet()
    {
        $client = $this->getMockedClient('sets/set_not_found.json', 404);

        $this->expectException(ScryfallException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('No set found for the given code.');

        $client->sets()->get('wrong_code');

    }
}