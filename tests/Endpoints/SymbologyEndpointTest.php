<?php

namespace Ypho\Scryfall\Tests\Endpoints;

use Ypho\Scryfall\Client;
use PHPUnit\Framework\TestCase;
use Ypho\Scryfall\Endpoints\SymbologyEndpoint;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Objects\ManaCost;
use Ypho\Scryfall\Objects\Symbol;

class SymbologyEndpointTest extends TestCase
{
    protected $mockedClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockedClient = $this->createMock(Client::class);
    }

    public function testParseMana()
    {
        $allSymbols = file_get_contents(__DIR__ . '/../../examples/json/mana_cost.json');

        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willReturn(json_decode($allSymbols, true));

        $symbologyEndpoint = new SymbologyEndpoint($mockedClient);
        $symbologyResponse = $symbologyEndpoint->parseMana('RUx');

        $this->assertInstanceOf(ManaCost::class, $symbologyResponse);
    }

    /**
     * @throws ScryfallException
     */
    public function testAll()
    {
        $allSymbols = file_get_contents(__DIR__ . '/../../examples/json/symbology.json');

        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willReturn(json_decode($allSymbols, true));

        $symbologyEndpoint = new SymbologyEndpoint($mockedClient);
        $symbologyResponse = $symbologyEndpoint->all();

        $this->assertCount(8, $symbologyResponse);
        $this->assertContainsOnlyInstancesOf(Symbol::class, $symbologyResponse);
    }

    public function testExceptionOnParseMana()
    {
        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willThrowException(new ScryfallException('Scryfall error'));

        $symbologyEndpoint = new SymbologyEndpoint($mockedClient);

        $this->expectException(ScryfallException::class);
        $symbologyEndpoint->parseMana('invalid-mana');
    }

    public function testExceptionOnAllSymbols()
    {
        $mockedClient = clone($this->mockedClient);
        $mockedClient->method('fetchResponse')
            ->willThrowException(new ScryfallException('Scryfall error'));

        $symbologyEndpoint = new SymbologyEndpoint($mockedClient);

        $this->expectException(ScryfallException::class);
        $symbologyEndpoint->all();
    }
}
