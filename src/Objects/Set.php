<?php

namespace Ypho\Scryfall\Objects;

use DateTime;

class Set implements ScryfallObject
{
    private string $id;
    private string $code;
    private ?string $mtgoCode;
    private ?string $arenaCode;
    private ?int $tcgPlayerId;
    private string $name;
    private string $setType;
    private ?DateTime $releaseDate;
    private ?string $blockCode;
    private ?string $block;
    private ?string $parentSetCode;
    private int $cardCount;
    private ?int $printedSize;
    private bool $isDigitalOnly;
    private bool $isFoilOnly;
    private bool $isNonFoilOnly;
    private string $scryfallUrl;
    private string $url;
    private string $iconSvgUrl;
    private string $searchUrl;

    public static function createFromApi(array $apiOutput): self
    {
        $set = new self();
        $set->id = $apiOutput['id'];
        $set->code = $apiOutput['code'];
        $set->mtgoCode = $apiOutput['mtgo_code'] ?? null;
        $set->arenaCode = $apiOutput['arena_code'] ?? null;
        $set->tcgPlayerId = $apiOutput['tcgplayer_id'] ?? null;
        $set->name = $apiOutput['name'];
        $set->setType = $apiOutput['set_type'];
        $set->releaseDate = ($apiOutput['released_at'] ? new DateTime($apiOutput['released_at']) : null);
        $set->blockCode = $apiOutput['block_code'] ?? null;
        $set->block = $apiOutput['block'] ?? null;
        $set->parentSetCode = $apiOutput['parent_set_code'] ?? null;
        $set->cardCount = $apiOutput['card_count'];
        $set->printedSize = $apiOutput['printed_size'] ?? null;
        $set->isDigitalOnly = $apiOutput['digital'];
        $set->isFoilOnly = $apiOutput['foil_only'];
        $set->isNonFoilOnly = $apiOutput['nonfoil_only'];
        $set->scryfallUrl = $apiOutput['scryfall_uri'];
        $set->url = $apiOutput['uri'];
        $set->iconSvgUrl = $apiOutput['icon_svg_uri'];
        $set->searchUrl = $apiOutput['search_uri'];

        return $set;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMtgoCode(): ?string
    {
        return $this->mtgoCode;
    }

    public function getArenaCode(): ?string
    {
        return $this->arenaCode;
    }

    public function getTcgPlayerId(): ?int
    {
        return $this->tcgPlayerId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSetType(): string
    {
        return $this->setType;
    }

    public function getReleaseDate(): ?DateTime
    {
        return $this->releaseDate;
    }

    public function getBlockCode(): ?string
    {
        return $this->blockCode;
    }

    public function getBlock(): ?string
    {
        return $this->block;
    }

    public function getParentSetCode(): ?string
    {
        return $this->parentSetCode;
    }

    public function getCardCount(): int
    {
        return $this->cardCount;
    }

    public function getPrintedSize(): ?int
    {
        return $this->printedSize;
    }

    public function isDigitalOnly(): bool
    {
        return $this->isDigitalOnly;
    }

    public function isFoilOnly(): bool
    {
        return $this->isFoilOnly;
    }

    public function isNonFoilOnly(): bool
    {
        return $this->isNonFoilOnly;
    }

    public function getScryfallUrl(): string
    {
        return $this->scryfallUrl;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getIconSvgUrl(): string
    {
        return $this->iconSvgUrl;
    }

    public function getSearchUrl(): string
    {
        return $this->searchUrl;
    }
}
