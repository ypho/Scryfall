<?php

namespace Ypho\Scryfall\Tests\Objects;

use DateTime;
use Ypho\Scryfall\Objects\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testSingleCardCoreFields()
    {
        $sphinxsRevelation = file_get_contents(__DIR__ . '/../../examples/json/sphinxs_revelation.json');
        $card = Card::createFromApi(json_decode($sphinxsRevelation, true));

        $this->assertInstanceOf(Card::class, $card);
        $this->assertEquals('Sphinx\'s Revelation', $card->getName());

        $this->assertEquals('0038ea4d-d0a6-44a4-bee6-24c03313d2bc', $card->getId());
        $this->assertNull($card->getArenaId());
        $this->assertEquals(63381, $card->getMtgoId());
        $this->assertEquals(63382, $card->getMtgoFoilId());
        $this->assertEquals('en', $card->getLanguage());
        $this->assertCount(1, $card->getMultiverseIds());
        $this->assertContains(426012, $card->getMultiverseIds());
        $this->assertEquals(128596, $card->getTcgPlayerId());
        $this->assertNull($card->getTcgPlayerEtchedId());
        $this->assertEquals(295857, $card->getCardMarketId());

        $this->assertEquals('normal', $card->getLayout());
        $this->assertEquals('71d83fca-e40e-4d0e-956d-d0d6da9cc472', $card->getOracleId());
        $this->assertEquals('https://api.scryfall.com/cards/search?order=released&q=oracleid%3A71d83fca-e40e-4d0e-956d-d0d6da9cc472&unique=prints', $card->getAllPrintsUrl());
        $this->assertEquals('https://api.scryfall.com/cards/0038ea4d-d0a6-44a4-bee6-24c03313d2bc/rulings', $card->getRulingsUrl());
        $this->assertEquals('https://scryfall.com/card/mm3/187/sphinxs-revelation?utm_source=api', $card->getScryfallUrl());
        $this->assertEquals('https://api.scryfall.com/cards/0038ea4d-d0a6-44a4-bee6-24c03313d2bc', $card->getUrl());
    }

    public function testSingleCardGameplayFields()
    {
        $sphinxsRevelation = file_get_contents(__DIR__ . '/../../examples/json/sphinxs_revelation.json');
        $card = Card::createFromApi(json_decode($sphinxsRevelation, true));

        $this->assertEquals(3.0, $card->getCmc());
        $this->assertContains('U', $card->getColorIdentity());
        $this->assertContains('W', $card->getColorIdentity());
        $this->assertNull($card->getColorIndicator());
        $this->assertContains('U', $card->getColors());
        $this->assertContains('W', $card->getColors());
        $this->assertEquals(2375, $card->getEdhrecRank());
        $this->assertNull($card->getHandModifier());
        $this->assertEmpty($card->getKeywords());
        $this->assertArrayHasKey('standard', $card->getLegalities());
        $this->assertArrayHasKey('modern', $card->getLegalities());
        $this->assertArrayHasKey('pioneer', $card->getLegalities());
        $this->assertArrayHasKey('explorer', $card->getLegalities());
        $this->assertNull($card->getLoyalty());
        $this->assertEquals('{X}{W}{U}{U}', $card->getManaCost());
        $this->assertEquals('Sphinx\'s Revelation', $card->getName());
        $this->assertEquals('You gain X life and draw X cards.', $card->getOracleText());
        $this->assertNull($card->getPennyRank());
        $this->assertNull($card->getPower());
        $this->assertNull($card->getProducedMana());
        $this->assertFalse($card->isReserved());
        $this->assertNull($card->getToughness());
        $this->assertEquals('Instant', $card->getTypeLine());
    }

    public function testSingleCardPrintFields()
    {
        $sphinxsRevelation = file_get_contents(__DIR__ . '/../../examples/json/sphinxs_revelation.json');
        $card = Card::createFromApi(json_decode($sphinxsRevelation, true));

        $this->assertEquals('Slawomir Maniak', $card->getArtist());
        $this->assertContains('d887bc66-2779-416c-a1ff-d8720242063e', $card->getArtistIds());
        $this->assertNull($card->getAttractionLights());
        $this->assertTrue($card->isInBooster());
        $this->assertEquals('black', $card->getBorderColor());
        $this->assertEquals('0aeebaf5-8c7d-4636-9e82-8c27447861f7', $card->getCardBackId());
        $this->assertEquals('187', $card->getCollectorNumber());
        $this->assertFalse($card->getHasContentWarning());
        $this->assertFalse($card->isDigitalOnly());
        $this->assertCount(2, $card->getFinishes());
        $this->assertContains('nonfoil', $card->getFinishes());
        $this->assertContains('foil', $card->getFinishes());
        $this->assertNotContains('etched', $card->getFinishes());
        $this->assertNull($card->getFlavorName());
        $this->assertEquals('"Let the knowledge of absolute law inspire you to live a life of absolute order."', $card->getFlavorText());
        $this->assertNull($card->getFrameEffects());
        $this->assertEquals('2015', $card->getFrame());
        $this->assertFalse($card->isFullArt());
        $this->assertCount(2, $card->getGames());
        $this->assertContains('paper', $card->getGames());
        $this->assertContains('mtgo', $card->getGames());
        $this->assertNotContains('mtga', $card->getGames());
        $this->assertTrue($card->isHasHighResImage());
        $this->assertEquals('fc8ef513-0c31-4b77-a688-a12ee6acf522', $card->getIllustrationId());
        $this->assertEquals('highres_scan', $card->getImageStatus());
        $this->assertCount(6, $card->getImageUrls());
        $this->assertArrayHasKey('small', $card->getImageUrls());
        $this->assertArrayHasKey('normal', $card->getImageUrls());
        $this->assertArrayHasKey('large', $card->getImageUrls());
        $this->assertArrayHasKey('png', $card->getImageUrls());
        $this->assertArrayHasKey('art_crop', $card->getImageUrls());
        $this->assertArrayHasKey('border_crop', $card->getImageUrls());
        $this->assertFalse($card->isOversized());
        $this->assertCount(6, $card->getPrices());
        $this->assertArrayHasKey('usd', $card->getPrices());
        $this->assertArrayHasKey('usd_foil', $card->getPrices());
        $this->assertArrayHasKey('usd_etched', $card->getPrices());
        $this->assertArrayHasKey('eur', $card->getPrices());
        $this->assertArrayHasKey('eur_foil', $card->getPrices());
        $this->assertArrayHasKey('tix', $card->getPrices());
        $this->assertNull($card->getPrintedName());
        $this->assertNull($card->getPrintedText());
        $this->assertNull($card->getPrintedTypeLine());
        $this->assertFalse($card->isPromo());
        $this->assertNull($card->getPromoTypes());
        $this->assertCount(3, $card->getPurchaseUrls());
        $this->assertArrayHasKey('tcgplayer', $card->getPurchaseUrls());
        $this->assertArrayHasKey('cardmarket', $card->getPurchaseUrls());
        $this->assertArrayHasKey('cardhoarder', $card->getPurchaseUrls());
        $this->assertEquals('mythic', $card->getRarity());
        $this->assertCount(4, $card->getRelatedUrls());
        $this->assertArrayHasKey('gatherer', $card->getRelatedUrls());
        $this->assertArrayHasKey('tcgplayer_infinite_articles', $card->getRelatedUrls());
        $this->assertArrayHasKey('tcgplayer_infinite_decks', $card->getRelatedUrls());
        $this->assertArrayHasKey('edhrec', $card->getRelatedUrls());
        $this->assertInstanceOf(DateTime::class, $card->getReleasedAt());
        $this->assertTrue($card->isReprint());
        $this->assertEquals('https://scryfall.com/sets/mm3?utm_source=api', $card->getScryfallSetUrl());
        $this->assertEquals('Modern Masters 2017', $card->getSetName());
        $this->assertEquals('https://api.scryfall.com/cards/search?order=set&q=e%3Amm3&unique=prints', $card->getSetSearchUrl());
        $this->assertEquals('masters', $card->getSetType());
        $this->assertEquals('https://api.scryfall.com/sets/02624962-f727-4c31-bbf2-a94fa6c5b653', $card->getSetUrl());
        $this->assertEquals('mm3', $card->getSetCode());
        $this->assertEquals('02624962-f727-4c31-bbf2-a94fa6c5b653', $card->getSetId());

        $this->assertFalse($card->isStorySpotlight());
        $this->assertFalse($card->isTextless());
        $this->assertFalse($card->isVariation());
        $this->assertNull($card->getVariationOfCardId());
        $this->assertEquals('oval', $card->getSecurityStamp());
        $this->assertNull($card->getWatermark());
        $this->assertNull($card->getPreviewedAt());
        $this->assertNull($card->getPreviewUrl());
        $this->assertNull($card->getPreviewSource());
    }
}
