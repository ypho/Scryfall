<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;

/**
 * Class Symbol
 * @package Scryfall\Responses
 */
class Symbol extends Base
{
    /** @var string */
    public $object;

    /** @var string */
    public $symbol;

    /** @var string */
    public $looseSymbol;

    /** @var string */
    public $description;

    /** @var bool */
    public $transposable;

    /** @var string */
    public $representsMana;

    /** @var string */
    public $appearsInManacost;

    /** @var int */
    public $cmc;

    /** @var bool */
    public $isFunny;

    /** @var array */
    public $colors;

    /** @var array */
    public $alternates;

    /**
     * Set constructor.
     * @param $data
     * @param bool $initialize
     */
    function __construct($data, $initialize = true)
    {
        if($data instanceof Response) {
            parent::__construct($data);
            $data = json_decode($data->getBody()->getContents());
        } else {
            parent::__construct(null, false);
        }

        $this->object = @$data->object;
        $this->symbol = @$data->symbol;
        $this->looseSymbol = @$data->loose_variant;
        $this->description = @$data->english;
        $this->transposable = @$data->transposable;
        $this->representsMana = @$data->represents_mana;
        $this->appearsInManacost = @$data->appears_in_mana_costs;
        $this->cmc = @$data->cmc;
        $this->isFunny = @$data->funny;
        $this->colors = @$data->colors;
        $this->alternates = @$data->gatherer_alternates;
    }
}