<?php

namespace Ypho\Scryfall\Objects;

class RelatedCard implements ScryfallObject
{
    private string $id;
    private string $component;
    private string $name;
    private string $typeLine;
    private string $url;

    public static function createFromApi(array $apiOutput): self
    {
        $relatedCard = new self();
        $relatedCard->id = $apiOutput['id'];
        $relatedCard->component = $apiOutput['component'];
        $relatedCard->name = $apiOutput['name'];
        $relatedCard->typeLine = $apiOutput['type_line'];
        $relatedCard->url = $apiOutput['uri'];

        return $relatedCard;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getComponent(): string
    {
        return $this->component;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTypeLine(): string
    {
        return $this->typeLine;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}