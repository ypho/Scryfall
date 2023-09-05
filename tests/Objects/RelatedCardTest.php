<?php

namespace Ypho\Scryfall\Tests\Objects;

use Ypho\Scryfall\Objects\Card;
use PHPUnit\Framework\TestCase;
use Ypho\Scryfall\Objects\RelatedCard;

class RelatedCardTest extends TestCase
{
    public function testRelatedCard()
    {
        $fableOfTheMirrorBreaker = file_get_contents(__DIR__ . '/../../examples/json/fable_of_the_mirror_breaker.json');
        $card = Card::createFromApi(json_decode($fableOfTheMirrorBreaker, true));

        $relatedParts = $card->getRelatedParts();
        $this->assertContainsOnlyInstancesOf(RelatedCard::class, $relatedParts);

        $treasureToken = $relatedParts[0];
        $this->assertEquals('6911181d-573b-41eb-96a4-799c96e008fc', $treasureToken->getId());
        $this->assertEquals('token', $treasureToken->getComponent());
        $this->assertEquals('Treasure', $treasureToken->getName());
        $this->assertEquals('Token Artifact — Treasure', $treasureToken->getTypeLine());
        $this->assertEquals('https://api.scryfall.com/cards/6911181d-573b-41eb-96a4-799c96e008fc', $treasureToken->getUrl());
    }
}
