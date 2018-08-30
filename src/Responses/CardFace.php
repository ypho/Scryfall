<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;

/**
 * Class CardFace
 * https://scryfall.com/docs/api/cards#card-face-objects
 *
 * @package Scryfall\Responses
 */
class CardFace extends Base
{
    /** @var string */
    public $object;

    /** @var string */
    public $name;

    /** @var string */
    public $manaCost;

    /** @var string */
    public $type;

    /** @var string */
    public $oracleText;

    /** @var string */
    public $flavorText;

    /** @var string */
    public $power;

    /** @var string */
    public $toughness;

    /** @var string */
    public $loyalty;

    /** @var string[] */
    public $colors;

    /** @var string[] */
    public $colorIndicator;

    /** @var string[] */
    public $images;

    /** @var string */
    public $printedName;

    /** @var string */
    public $printedText;

    /** @var string */
    public $printedType;

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

        $this->object = $data->object;
        $this->name = @$data->name;
        $this->manaCost = @$data->mana_cost;
        $this->type = @$data->type_line;
        $this->oracleText = @$data->oracle_text;
        $this->flavorText = @$data->flavor_text;
        $this->power = @$data->power;
        $this->toughness= @$data->toughness;
        $this->loyalty = @$data->loyalty;
        $this->colors = @$data->colors;
        $this->colorIndicator = @$data->colorIndicator;
        $this->printedName = @$data->printed_name;
        $this->printedText = @$data->printed_text;
        $this->printedType = @$data->printed_type_line;

        if(isset($data->image_uris)) {
            $images = $data->image_uris;

            $this->images = new \stdClass();
            $this->images->small = @$images->small;
            $this->images->normal = @$images->normal;
            $this->images->large = @$images->large;
            $this->images->png = @$images->png;
            $this->images->art_crop = @$images->art_crop;
            $this->images->border_crop = @$images->border_crop;
        }
    }
}