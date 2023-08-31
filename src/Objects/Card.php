<?php

namespace Ypho\Scryfall\Objects;

use DateTime;

class Card implements ScryfallObject
{
    // Core Fields
    private string $id;
    private ?int $arenaId;
    private ?int $mtgoId;
    private ?int $mtgoFoilId;
    private string $language;
    private ?array $multiverseIds;
    private ?int $tcgPlayerId;
    private ?int $tcgPlayerEtchedId;
    private ?int $cardMarketId;
    private string $layout;
    private ?string $oracleId;
    private string $allPrintsUrl;
    private string $rulingsUrl;
    private string $scryfallUrl;
    private string $url;

    // Gameplay Fields
    private ?array $relatedParts;
    private ?array $cardFaces;
    private float $cmc;
    private array $colorIdentity;
    private ?array $colorIndicator;
    private ?array $colors;
    private ?int $edhrecRank;
    private ?string $handModifier;
    private array $keywords;
    private array $legalities;
    private ?string $lifeModifier;
    private ?string $loyalty;
    private ?string $manaCost;
    private string $name;
    private ?string $oracleText;
    private ?int $pennyRank;
    private ?string $power;
    private ?array $producedMana;
    private bool $isReserved;
    private ?string $toughness;
    private string $typeLine;

    // Print Fields
    private ?string $artist;
    private ?array $artistIds;
    private ?array $attractionLights;
    private bool $inBooster;
    private string $borderColor;
    private ?string $cardBackId;
    private string $collectorNumber;
    private ?bool $hasContentWarning;
    private bool $isDigitalOnly;
    private array $finishes;
    private ?string $flavorName;
    private ?string $flavorText;
    private ?array $frameEffects;
    private string $frame;
    private bool $isFullArt;
    private array $games;
    private bool $hasHighResImage;
    private ?string $illustrationId;
    private string $imageStatus;
    private ?array $imageUrls;
    private bool $isOversized;
    private array $prices;
    private ?string $printedName;
    private ?string $printedText;
    private ?string $printedTypeLine;
    private bool $isPromo;
    private ?array $promoTypes;
    private ?array $purchaseUrls;
    private string $rarity;
    private array $relatedUrls;
    private DateTime $releasedAt;
    private bool $isReprint;
    private string $scryfallSetUrl;
    private string $setName;
    private string $setSearchUrl;
    private string $setType;
    private string $setUrl;
    private string $setCode;
    private string $setId;
    private bool $isStorySpotlight;
    private bool $isTextless;
    private bool $isVariation;
    private ?string $variationOfCardId;
    private ?string $securityStamp;
    private ?string $watermark;
    private ?DateTime $previewedAt;
    private ?string $previewUrl;
    private ?string $previewSource;

    public static function createFromApi(array $apiOutput): self
    {
        $card = new self();

        // Core Fields
        $card->id = $apiOutput['id'];
        $card->arenaId = $apiOutput['arena_id'] ?? null;
        $card->mtgoId = $apiOutput['mtgo_id'] ?? null;
        $card->mtgoFoilId = $apiOutput['mtgo_foil_id'] ?? null;
        $card->language = $apiOutput['lang'];
        $card->multiverseIds = $apiOutput['multiverse_ids'] ?? null;
        $card->tcgPlayerId = $apiOutput['tcgplayer_id'] ?? null;
        $card->tcgPlayerEtchedId = $apiOutput['tcgplayer_etched_id'] ?? null;
        $card->cardMarketId = $apiOutput['cardmarket_id'] ?? null;
        $card->layout = $apiOutput['layout'];
        $card->oracleId = $apiOutput['oracle_id'];
        $card->allPrintsUrl = $apiOutput['prints_search_uri'];
        $card->rulingsUrl = $apiOutput['rulings_uri'];
        $card->scryfallUrl = $apiOutput['scryfall_uri'];
        $card->url = $apiOutput['uri'];

        // Gameplay Fields - Related
        $card->relatedParts = null;
        if (count($apiOutput['all_parts'] ?? []) > 0) {
            $card->relatedParts = [];
            foreach ($apiOutput['all_parts'] as $part) {
                $card->relatedParts[] = RelatedCard::createFromApi($part);
            }
        }

        // Gameplay Fields - Faces
        $card->cardFaces = null;
        if (count($apiOutput['card_faces'] ?? []) > 0) {
            $card->cardFaces = [];
            foreach ($apiOutput['card_faces'] as $face) {
                $card->cardFaces[] = CardFace::createFromApi($face);
            }
        }

        // Gameplay Fields - Others
        $card->cmc = $apiOutput['cmc'];
        $card->colorIdentity = $apiOutput['color_identity'];
        $card->colorIndicator = $apiOutput['color_indicator'] ?? null;
        $card->colors = $apiOutput['colors'] ?? null;
        $card->edhrecRank = $apiOutput['edhrec_rank'] ?? null;
        $card->handModifier = $apiOutput['hand_modifier'] ?? null;
        $card->keywords = $apiOutput['keywords'];
        $card->legalities = $apiOutput['legalities'];
        $card->lifeModifier = $apiOutput['life_modifier'] ?? null;
        $card->loyalty = $apiOutput['loyalty'] ?? null;
        $card->manaCost = $apiOutput['mana_cost'] ?? null;
        $card->name = $apiOutput['name'];
        $card->oracleText = $apiOutput['oracle_text'] ?? null;
        $card->pennyRank = $apiOutput['penny_rank'] ?? null;
        $card->power = $apiOutput['power'] ?? null;
        $card->producedMana = $apiOutput['produced_mana'] ?? null;
        $card->isReserved = $apiOutput['reserved'];
        $card->toughness = $apiOutput['toughness'] ?? null;
        $card->typeLine = $apiOutput['type_line'];

        // Print Fields
        $card->artist = $apiOutput['artist'] ?? null;
        $card->artistIds = $apiOutput['artist_ids'] ?? null;
        $card->attractionLights = $apiOutput['attraction_lights'] ?? null;
        $card->inBooster = $apiOutput['booster'];
        $card->borderColor = $apiOutput['border_color'];
        $card->cardBackId = $apiOutput['card_back_id'] ?? null;
        $card->collectorNumber = $apiOutput['collector_number'];
        $card->hasContentWarning = $apiOutput['content_warning'] ?? false;
        $card->isDigitalOnly = $apiOutput['digital'];
        $card->finishes = $apiOutput['finishes'];
        $card->flavorName = $apiOutput['flavor_name'] ?? null;
        $card->flavorText = $apiOutput['flavor_text'] ?? null;
        $card->frameEffects = $apiOutput['frame_effects'] ?? null;
        $card->frame = $apiOutput['frame'];
        $card->isFullArt = $apiOutput['full_art'];
        $card->games = $apiOutput['games'];
        $card->hasHighResImage = $apiOutput['highres_image'];
        $card->illustrationId = $apiOutput['illustration_id'] ?? null;
        $card->imageStatus = $apiOutput['image_status'];
        $card->imageUrls = $apiOutput['image_uris'] ?? null;
        $card->isOversized = $apiOutput['oversized'];
        $card->prices = $apiOutput['prices'];
        $card->printedName = $apiOutput['printed_name'] ?? null;
        $card->printedText = $apiOutput['printed_text'] ?? null;
        $card->printedTypeLine = $apiOutput['printed_type_line'] ?? null;
        $card->isPromo = $apiOutput['promo'];
        $card->promoTypes = $apiOutput['promo_types'] ?? null;
        $card->purchaseUrls = $apiOutput['purchase_uris'] ?? null;
        $card->rarity = $apiOutput['rarity'];
        $card->relatedUrls = $apiOutput['related_uris'];
        $card->releasedAt = new DateTime($apiOutput['released_at']);
        $card->isReprint = $apiOutput['reprint'];
        $card->scryfallSetUrl = $apiOutput['scryfall_set_uri'];
        $card->setName = $apiOutput['set_name'];
        $card->setSearchUrl = $apiOutput['set_search_uri'];
        $card->setType = $apiOutput['set_type'];
        $card->setUrl = $apiOutput['set_uri'];
        $card->setCode = $apiOutput['set'];
        $card->setId = $apiOutput['set_id'];
        $card->isStorySpotlight = $apiOutput['story_spotlight'];
        $card->isTextless = $apiOutput['textless'];
        $card->isVariation = $apiOutput['variation'];
        $card->variationOfCardId = $apiOutput['variation_of'] ?? null;
        $card->securityStamp = $apiOutput['security_stamp'] ?? null;
        $card->watermark = $apiOutput['watermark'] ?? null;
        $card->previewedAt = (isset($apiOutput['preview.previewed_at']) ? new DateTime($apiOutput['preview.previewed_at']) : null);
        $card->previewUrl = $apiOutput['preview.source_uri'] ?? null;
        $card->previewSource = $apiOutput['preview.source'] ?? null;

        return $card;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getArenaId(): ?int
    {
        return $this->arenaId;
    }

    public function getMtgoId(): ?int
    {
        return $this->mtgoId;
    }

    public function getMtgoFoilId(): ?int
    {
        return $this->mtgoFoilId;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getMultiverseIds(): ?array
    {
        return $this->multiverseIds;
    }

    public function getTcgPlayerId(): ?int
    {
        return $this->tcgPlayerId;
    }

    public function getTcgPlayerEtchedId(): ?int
    {
        return $this->tcgPlayerEtchedId;
    }

    public function getCardMarketId(): ?int
    {
        return $this->cardMarketId;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

    public function getOracleId(): ?string
    {
        return $this->oracleId;
    }

    public function getAllPrintsUrl(): string
    {
        return $this->allPrintsUrl;
    }

    public function getRulingsUrl(): string
    {
        return $this->rulingsUrl;
    }

    public function getScryfallUrl(): string
    {
        return $this->scryfallUrl;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getRelatedParts(): ?array
    {
        return $this->relatedParts;
    }

    public function getCardFaces(): ?array
    {
        return $this->cardFaces;
    }

    public function getCmc(): float
    {
        return $this->cmc;
    }

    public function getColorIdentity(): array
    {
        return $this->colorIdentity;
    }

    public function getColorIndicator(): ?array
    {
        return $this->colorIndicator;
    }

    public function getColors(): ?array
    {
        return $this->colors;
    }

    public function getEdhrecRank(): ?int
    {
        return $this->edhrecRank;
    }

    public function getHandModifier(): ?string
    {
        return $this->handModifier;
    }

    public function getKeywords(): array
    {
        return $this->keywords;
    }

    public function getLegalities(): array
    {
        return $this->legalities;
    }

    public function getLifeModifier(): ?string
    {
        return $this->lifeModifier;
    }

    public function getLoyalty(): ?string
    {
        return $this->loyalty;
    }

    public function getManaCost(): ?string
    {
        return $this->manaCost;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOracleText(): ?string
    {
        return $this->oracleText;
    }

    public function getPennyRank(): ?int
    {
        return $this->pennyRank;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function getProducedMana(): ?array
    {
        return $this->producedMana;
    }

    public function isReserved(): bool
    {
        return $this->isReserved;
    }

    public function getToughness(): ?string
    {
        return $this->toughness;
    }

    public function getTypeLine(): string
    {
        return $this->typeLine;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function getArtistIds(): ?array
    {
        return $this->artistIds;
    }

    public function getAttractionLights(): ?array
    {
        return $this->attractionLights;
    }

    public function isInBooster(): bool
    {
        return $this->inBooster;
    }

    public function getBorderColor(): string
    {
        return $this->borderColor;
    }

    public function getCardBackId(): ?string
    {
        return $this->cardBackId;
    }

    public function getCollectorNumber(): string
    {
        return $this->collectorNumber;
    }

    public function getHasContentWarning(): ?bool
    {
        return $this->hasContentWarning;
    }

    public function isDigitalOnly(): bool
    {
        return $this->isDigitalOnly;
    }

    public function getFinishes(): array
    {
        return $this->finishes;
    }

    public function getFlavorName(): ?string
    {
        return $this->flavorName;
    }

    public function getFlavorText(): ?string
    {
        return $this->flavorText;
    }

    public function getFrameEffects(): ?array
    {
        return $this->frameEffects;
    }

    public function getFrame(): string
    {
        return $this->frame;
    }

    public function isFullArt(): bool
    {
        return $this->isFullArt;
    }

    public function getGames(): array
    {
        return $this->games;
    }

    public function isHasHighResImage(): bool
    {
        return $this->hasHighResImage;
    }

    public function getIllustrationId(): ?string
    {
        return $this->illustrationId;
    }

    public function getImageStatus(): string
    {
        return $this->imageStatus;
    }

    public function getImageUrls(): ?array
    {
        return $this->imageUrls;
    }

    public function isOversized(): bool
    {
        return $this->isOversized;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }

    public function getPrintedName(): ?string
    {
        return $this->printedName;
    }

    public function getPrintedText(): ?string
    {
        return $this->printedText;
    }

    public function getPrintedTypeLine(): ?string
    {
        return $this->printedTypeLine;
    }

    public function isPromo(): bool
    {
        return $this->isPromo;
    }

    public function getPromoTypes(): ?array
    {
        return $this->promoTypes;
    }

    public function getPurchaseUrls(): ?array
    {
        return $this->purchaseUrls;
    }

    public function getRarity(): string
    {
        return $this->rarity;
    }

    public function getRelatedUrls(): array
    {
        return $this->relatedUrls;
    }

    public function getReleasedAt(): DateTime
    {
        return $this->releasedAt;
    }

    public function isReprint(): bool
    {
        return $this->isReprint;
    }

    public function getScryfallSetUrl(): string
    {
        return $this->scryfallSetUrl;
    }

    public function getSetName(): string
    {
        return $this->setName;
    }

    public function getSetSearchUrl(): string
    {
        return $this->setSearchUrl;
    }

    public function getSetType(): string
    {
        return $this->setType;
    }

    public function getSetUrl(): string
    {
        return $this->setUrl;
    }

    public function getSetCode(): string
    {
        return $this->setCode;
    }

    public function getSetId(): string
    {
        return $this->setId;
    }

    public function isStorySpotlight(): bool
    {
        return $this->isStorySpotlight;
    }

    public function isTextless(): bool
    {
        return $this->isTextless;
    }

    public function isVariation(): bool
    {
        return $this->isVariation;
    }

    public function getVariationOfCardId(): ?string
    {
        return $this->variationOfCardId;
    }

    public function getSecurityStamp(): ?string
    {
        return $this->securityStamp;
    }

    public function getWatermark(): ?string
    {
        return $this->watermark;
    }

    public function getPreviewedAt(): ?DateTime
    {
        return $this->previewedAt;
    }

    public function getPreviewUrl(): ?string
    {
        return $this->previewUrl;
    }

    public function getPreviewSource(): ?string
    {
        return $this->previewSource;
    }
}