<?php

namespace Tests\Endpoint;

use Tests\TestCase;
use Ypho\Scryfall\Exception\ScryfallException;
use Ypho\Scryfall\Responses\ParsedMana;
use Ypho\Scryfall\Responses\Symbol;
use Ypho\Scryfall\Responses\Symbols;

class SymbolsTest extends TestCase
{
    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testAllSymbols()
    {
        $client = $this->getMockedClient('symbols/all.json');
        $symbols = $client->symbols()->all();

        $this->assertInstanceOf(Symbols::class, $symbols);
        $this->assertContainsOnlyInstancesOf(Symbol::class, $symbols->getIterator());
    }

    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testParseManacost()
    {
        $client = $this->getMockedClient('symbols/parse.json');
        $manacost = $client->symbols()->parse('rgx');

        $this->assertInstanceOf(ParsedMana::class, $manacost);
        $this->assertEquals('{X}{R}{G}', $manacost->cost);
    }

    /**
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function testParseWrongManaCost()
    {
        $client = $this->getMockedClient('symbols/error_parsing.json', 429);

        $this->expectException(ScryfallException::class);
        $this->expectExceptionCode(429);
        $this->expectExceptionMessage('The string fragment(s) “A” could not be understood as part of mana cost.');

        $client->symbols()->parse('ABC');
    }
}