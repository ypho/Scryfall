<?php

namespace Ypho\Scryfall\Tests\Objects;

use Ypho\Scryfall\Objects\Card;
use PHPUnit\Framework\TestCase;
use Ypho\Scryfall\Objects\CardFace;

class CardFaceTest extends TestCase
{
    public function testCreateFromApi()
    {
        $delverOfSecrets = file_get_contents(__DIR__ . '/../../examples/json/delver_of_secrets.json');
        $card = Card::createFromApi(json_decode($delverOfSecrets, true));

        $this->assertInstanceOf(Card::class, $card);
        $this->assertEquals('Delver of Secrets // Insectile Aberration', $card->getName());

        $this->assertCount(2, $card->getCardFaces());

        /** @var CardFace $frontFace */
        $frontFace = $card->getCardFaces()[0];

        $this->assertEquals('Nils Hamm', $frontFace->getArtist());
        $this->assertNull($frontFace->getCmc());
        $this->assertNull($frontFace->getColorIndicator());
        $this->assertCount(1, $frontFace->getColors());
        $this->assertContains('U', $frontFace->getColors());
        $this->assertNull($frontFace->getFlavorText());
        $this->assertEquals('1c2fee9b-89ea-4ab1-a751-451c3cd65a88', $frontFace->getIllustrationId());
        $this->assertCount(6, $frontFace->getImageUrls());
        $this->assertArrayHasKey('small', $frontFace->getImageUrls());
        $this->assertArrayHasKey('normal', $frontFace->getImageUrls());
        $this->assertArrayHasKey('large', $frontFace->getImageUrls());
        $this->assertArrayHasKey('png', $frontFace->getImageUrls());
        $this->assertArrayHasKey('art_crop', $frontFace->getImageUrls());
        $this->assertArrayHasKey('border_crop', $frontFace->getImageUrls());
        $this->assertNull($frontFace->getLayout());
        $this->assertNull($frontFace->getLoyalty());
        $this->assertEquals('{U}', $frontFace->getManaCost());
        $this->assertEquals('Delver of Secrets', $frontFace->getName());
        $this->assertNull($frontFace->getOracleId());
        $this->assertEquals('At the beginning of your upkeep, look at the top card of your library. You may reveal that card. If an instant or sorcery card is revealed this way, transform Delver of Secrets.', $frontFace->getOracleText());
        $this->assertEquals('1', $frontFace->getPower());
        $this->assertNull($frontFace->getPrintedName());
        $this->assertNull($frontFace->getPrintedText());
        $this->assertNull($frontFace->getPrintedTypeLine());
        $this->assertEquals('1', $frontFace->getToughness());
        $this->assertEquals('Creature — Human Wizard', $frontFace->getTypeLine());
        $this->assertNull($frontFace->getWatermark());
    }
}
