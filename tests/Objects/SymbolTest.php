<?php

namespace Ypho\Scryfall\Tests\Objects;

use Ypho\Scryfall\Objects\Symbol;
use PHPUnit\Framework\TestCase;

class SymbolTest extends TestCase
{
    public function testTapSymbol()
    {
        $tapSymbol = file_get_contents(__DIR__ . '/../../examples/json/symbol_tap.json');
        $symbol = Symbol::createFromApi(json_decode($tapSymbol, true));

        $this->assertEquals('{T}', $symbol->getSymbol());
        $this->assertEquals('tap this permanent', $symbol->getEnglish());
        $this->assertFalse($symbol->isTransposable());
        $this->assertFalse($symbol->isRepresentsMana());
        $this->assertEquals(0, $symbol->getManaValue());
        $this->assertFalse($symbol->isAppearsInManaCosts());
        $this->assertFalse($symbol->isFunny());
        $this->assertEmpty($symbol->getColors());
        $this->assertCount(2, $symbol->getGathererAlternates());
        $this->assertContains('ocT', $symbol->getGathererAlternates());
        $this->assertContains('oT', $symbol->getGathererAlternates());
        $this->assertEquals('https://svgs.scryfall.io/card-symbols/T.svg', $symbol->getSvgUrl());

        $this->assertNull($symbol->getLooseVariant());
    }

    public function testManaXSymbol()
    {
        $tapSymbol = file_get_contents(__DIR__ . '/../../examples/json/symbol_x.json');
        $symbol = Symbol::createFromApi(json_decode($tapSymbol, true));

        $this->assertEquals('{X}', $symbol->getSymbol());
        $this->assertTrue($symbol->isRepresentsMana());
        $this->assertTrue($symbol->isAppearsInManaCosts());
    }
}
