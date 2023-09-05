<?php

namespace Ypho\Scryfall\Tests\Endpoints;

use Ypho\Scryfall\Client;
use PHPUnit\Framework\TestCase;
use Ypho\Scryfall\Endpoints\SetEndpoint;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Objects\Set;

class SetEndpointTest extends TestCase
{
    protected $mockedClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockedClient = $this->createMock(Client::class);
    }

    public function testGetSingleSet()
    {
        $pioneerChallenger2021 = file_get_contents(__DIR__ . '/../../examples/json/set_pioneer_challenger_2021.json');

        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willReturn(json_decode($pioneerChallenger2021, true));

        $setEndpoint = new SetEndpoint($mockedClient);
        $setResponse = $setEndpoint->get('q06');

        $this->assertInstanceOf(Set::class, $setResponse);
    }

    public function testGetAllSets()
    {
        $allSets = file_get_contents(__DIR__ . '/../../examples/json/set_all.json');

        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willReturn(json_decode($allSets, true));

        $setEndpoint = new SetEndpoint($mockedClient);
        $setResponse = $setEndpoint->all();

        $this->assertCount(4, $setResponse);
        $this->assertContainsOnlyInstancesOf(Set::class, $setResponse);
    }

    public function testExceptionOnWrongSetId()
    {
        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willThrowException(new ScryfallException('Scryfall error'));

        $setEndpoint = new SetEndpoint($mockedClient);

        $this->expectException(ScryfallException::class);
        $setEndpoint->get('non-existing-id');
    }

    public function testExceptionOnAllSets()
    {
        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willThrowException(new ScryfallException('Scryfall error'));

        $setEndpoint = new SetEndpoint($mockedClient);

        $this->expectException(ScryfallException::class);
        $setEndpoint->all();
    }
}
