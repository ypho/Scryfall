<?php

namespace Ypho\Scryfall\Objects;

class CardFace implements ScryfallObject
{
    private ?string $artist;
    private ?float $cmc;
    private ?array $colorIndicator;
    private ?array $colors;
    private ?string $flavorText;
    private ?string $illustrationId;
    private ?array $imageUrls;
    private ?string $layout;
    private ?string $loyalty;
    private string $manaCost;
    private string $name;
    private ?string $oracleId;
    private ?string $oracleText;
    private ?string $power;
    private ?string $printedName;
    private ?string $printedText;
    private ?string $printedTypeLine;
    private ?string $toughness;
    private ?string $typeLine;
    private ?string $watermark;

    public static function createFromApi(array $apiOutput): self
    {
        $cardFace = new self();
        $cardFace->artist = $apiOutput['artist'] ?? null;
        $cardFace->cmc = $apiOutput['cmc'] ?? null;
        $cardFace->colorIndicator = $apiOutput['color_indicator'] ?? null;
        $cardFace->colors = $apiOutput['colors'] ?? null;
        $cardFace->flavorText = $apiOutput['flavor_text'] ?? null;
        $cardFace->illustrationId= $apiOutput['illustration_id'] ?? null;
        $cardFace->imageUrls = $apiOutput['image_uris'] ?? null;
        $cardFace->layout = $apiOutput['layout'] ?? null;
        $cardFace->loyalty = $apiOutput['loyalty'] ?? null;
        $cardFace->manaCost = $apiOutput['mana_cost'] ?? null;
        $cardFace->name = $apiOutput['name'] ?? null;
        $cardFace->oracleId = $apiOutput['oracle_id'] ?? null;
        $cardFace->oracleText = $apiOutput['oracle_text'] ?? null;
        $cardFace->power = $apiOutput['power'] ?? null;
        $cardFace->printedName = $apiOutput['printed_name'] ?? null;
        $cardFace->printedText = $apiOutput['printed_text'] ?? null;
        $cardFace->printedTypeLine = $apiOutput['printed_type_line'] ?? null;
        $cardFace->toughness = $apiOutput['toughness'] ?? null;
        $cardFace->typeLine = $apiOutput['type_line'] ?? null;
        $cardFace->watermark = $apiOutput['watermark'] ?? null;

        return $cardFace;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function getCmc(): ?float
    {
        return $this->cmc;
    }

    public function getColorIndicator(): ?array
    {
        return $this->colorIndicator;
    }

    public function getColors(): ?array
    {
        return $this->colors;
    }

    public function getFlavorText(): ?string
    {
        return $this->flavorText;
    }

    public function getIllustrationId(): ?string
    {
        return $this->illustrationId;
    }

    public function getImageUrls(): ?array
    {
        return $this->imageUrls;
    }

    public function getLayout(): ?string
    {
        return $this->layout;
    }

    public function getLoyalty(): ?string
    {
        return $this->loyalty;
    }

    public function getManaCost(): string
    {
        return $this->manaCost;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOracleId(): ?string
    {
        return $this->oracleId;
    }

    public function getOracleText(): ?string
    {
        return $this->oracleText;
    }

    public function getPower(): ?string
    {
        return $this->power;
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

    public function getToughness(): ?string
    {
        return $this->toughness;
    }

    public function getTypeLine(): ?string
    {
        return $this->typeLine;
    }

    public function getWatermark(): ?string
    {
        return $this->watermark;
    }
}