<?php

namespace Ypho\Scryfall\Tests\Objects;

use DateTime;
use Ypho\Scryfall\Objects\Set;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testSet()
    {
        $pioneerChallenger2021 = file_get_contents(__DIR__ . '/../../examples/json/pioneer_challenger_2021.json');
        $set = Set::createFromApi(json_decode($pioneerChallenger2021, true));

        $this->assertInstanceOf(Set::class, $set);
        $this->assertEquals('Pioneer Challenger Decks 2021', $set->getName());
        $this->assertEquals('ae1cbc8b-eb24-4e7e-9cd4-6691f5478767', $set->getId());
        $this->assertEquals('q06', $set->getCode());
        $this->assertEquals('https://api.scryfall.com/sets/ae1cbc8b-eb24-4e7e-9cd4-6691f5478767', $set->getUrl());
        $this->assertEquals('https://scryfall.com/sets/q06', $set->getScryfallUrl());
        $this->assertEquals('https://api.scryfall.com/cards/search?include_extras=true&include_variations=true&order=set&q=e%3Aq06&unique=prints', $set->getSearchUrl());
        $this->assertEquals(new DateTime('2021-10-15'), $set->getReleaseDate());
        $this->assertEquals('box', $set->getSetType());
        $this->assertEquals(10, $set->getCardCount());
        $this->assertFalse($set->isDigitalOnly());
        $this->assertTrue($set->isNonFoilOnly());
        $this->assertFalse($set->isFoilOnly());
        $this->assertEquals('https://svgs.scryfall.io/sets/star.svg?1693195200', $set->getIconSvgUrl());

        $this->assertNull($set->getMtgoCode());
        $this->assertNull($set->getArenaCode());
        $this->assertNull($set->getTcgPlayerId());
        $this->assertNull($set->getBlockCode());
        $this->assertNull($set->getBlock());
        $this->assertNull($set->getParentSetCode());
        $this->assertNull($set->getPrintedSize());
    }
}
