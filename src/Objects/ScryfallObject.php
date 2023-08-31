<?php

namespace Ypho\Scryfall\Objects;

interface ScryfallObject
{
    public static function createFromApi(array $apiOutput): self;
}