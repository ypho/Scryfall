<?php

namespace Ypho\Scryfall\Objects;

class Symbol implements ScryfallObject
{
    private string $symbol;
    private ?string $looseVariant;
    private string $english;
    private bool $isTransposable;
    private bool $representsMana;
    private ?float $manaValue;
    private bool $appearsInManaCosts;
    private bool $isFunny;
    private array $colors;
    private ?array $gathererAlternates;
    private ?string $svgUrl;

    public static function createFromApi(array $apiOutput): self
    {
        $symbol = new self();
        $symbol->symbol = $apiOutput['symbol'];
        $symbol->looseVariant = $apiOutput['loose_variant'] ?? null;
        $symbol->english = $apiOutput['english'];
        $symbol->isTransposable = $apiOutput['transposable'];
        $symbol->representsMana = $apiOutput['represents_mana'];
        $symbol->manaValue = $apiOutput['mana_value'] ?? 0.0;
        $symbol->appearsInManaCosts = $apiOutput['appears_in_mana_costs'];
        $symbol->isFunny = $apiOutput['funny'];
        $symbol->colors = $apiOutput['colors'];
        $symbol->gathererAlternates = $apiOutput['gatherer_alternates'] ?? null;
        $symbol->svgUrl = $apiOutput['svg_uri'] ?? null;

        return $symbol;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getLooseVariant(): ?string
    {
        return $this->looseVariant;
    }

    public function getEnglish(): string
    {
        return $this->english;
    }

    public function isTransposable(): bool
    {
        return $this->isTransposable;
    }

    public function isRepresentsMana(): bool
    {
        return $this->representsMana;
    }

    public function getManaValue(): ?float
    {
        return $this->manaValue;
    }

    public function isAppearsInManaCosts(): bool
    {
        return $this->appearsInManaCosts;
    }

    public function isFunny(): bool
    {
        return $this->isFunny;
    }

    public function getColors(): array
    {
        return $this->colors;
    }

    public function getGathererAlternates(): ?array
    {
        return $this->gathererAlternates;
    }

    public function getSvgUrl(): ?string
    {
        return $this->svgUrl;
    }
}