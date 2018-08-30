<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;

/**
 * Class Manacost
 * https://scryfall.com/docs/api/card-symbols/parse-mana
 *
 * @package Scryfall\Responses
 */
class ParsedMana extends Base
{
    /** @var string */
    public $object;

    /** @var string */
    public $cost;

    /** @var array */
    public $colors;

    /** @var int */
    public $cmc;

    /** @var bool */
    public $isColorless;

    /** @var bool */
    public $isMonoColor;

    /** @var bool */
    public $isMultiColor;

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
        $this->cost = @$data->cost;
        $this->colors = @$data->colors;
        $this->cmc = @$data->cmc;
        $this->isColorless = @$data->colorless;
        $this->isMonoColor = @$data->monocolored;
        $this->isMultiColor = @$data->multicolored;
    }
}