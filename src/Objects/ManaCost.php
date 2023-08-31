<?php

namespace Ypho\Scryfall\Objects;

class ManaCost implements ScryfallObject
{
    private string $cost;
    private array $colors;
    private float $cmc;
    private bool $isColorless;
    private bool $isMonoColored;
    private bool $isMultiColored;

    public static function createFromApi(array $apiOutput): self
    {
        $manaCost = new self();
        $manaCost->cost = $apiOutput['cost'];
        $manaCost->colors = $apiOutput['colors'];
        $manaCost->cmc = $apiOutput['cmc'];
        $manaCost->isColorless = $apiOutput['colorless'];
        $manaCost->isMonoColored = $apiOutput['monocolored'];
        $manaCost->isMultiColored = $apiOutput['multicolored'];

        return $manaCost;
    }

    public function getCost(): string
    {
        return $this->cost;
    }

    public function getColors(): array
    {
        return $this->colors;
    }

    public function getCmc(): float
    {
        return $this->cmc;
    }

    public function isColorless(): bool
    {
        return $this->isColorless;
    }

    public function isMonoColored(): bool
    {
        return $this->isMonoColored;
    }

    public function isMultiColored(): bool
    {
        return $this->isMultiColored;
    }
}