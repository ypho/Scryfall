<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;
use Ypho\Scryfall\ScryfallIterator;

/**
 * Class Card
 * @package Scryfall\Responses
 */
class Card extends Base
{
    /** @var string */
    public $object;

    /** @var int */
    public $idScryfall;

    /** @var int */
    public $idOracle;

    /** @var int */
    public $idMtgo;

    /** @var int */
    public $idMtgoFoil;

    /** @var int */
    public $idArena;

    /** @var int[] */
    public $idsMultiverse;

    /** @var string */
    public $language;

    /** @var string */
    public $name;

    /** @var string */
    public $printedName;

    /** @var string */
    public $type;

    /** @var string */
    public $printedType;

    /** @var string */
    public $oracleText;

    /** @var string */
    public $printedText;

    /** @var string */
    public $flavorText;

    /** @var string */
    public $manaCost;

    /** @var float */
    public $cmc;

    /** @var string[] */
    public $colors;

    /** @var string[] */
    public $colorIdentity;

    /** @var string[] */
    public $colorIndicator;

    /** @var string */
    public $number;

    /** @var string */
    public $rarity;

    /** @var string */
    public $power;

    /** @var string */
    public $toughness;

    /** @var string */
    public $loyalty;

    /** @var CardFace[] */
    public $cardFaces;

    /** @var string */
    public $set;

    /** @var string */
    public $setName;

    /** @var string */
    public $layout;

    /** @var string */
    public $frame;

    /** @var string */
    public $borderColor;

    /** @var string */
    public $watermark;

    /** @var string */
    public $artist;

    /** @var string */
    public $handModifier;

    /** @var string */
    public $lifeModifier;

    /** @var bool */
    public $isReserved;

    /** @var bool */
    public $isFoil;

    /** @var bool */
    public $isNonFoil;

    /** @var bool */
    public $isReprint;

    /** @var bool */
    public $isOversized;

    /** @var bool */
    public $isDigital;

    /** @var bool */
    public $isFullart;

    /** @var bool */
    public $isTimeshifted;

    /** @var bool */
    public $isColorshifted;

    /** @var bool */
    public $isFutureshifted;

    /** @var \stdClass */
    public $legalities;

    /** @var \stdClass */
    public $images;

    /** @var \stdClass */
    public $prices;

    /** @var \stdClass[] */
    public $related;

    /**
     * Set constructor.
     * @param $data
     * @param bool $initialize
     */
    function __construct($data, $initialize = true)
    {
        if($data instanceof Response) {
            parent::__construct($data, $initialize);
            $data = json_decode($data->getBody()->getContents());
        } else {
            parent::__construct(null, false);
        }

        $this->object = $data->object;

        $this->idScryfall = @$data->id;
        $this->idOracle = @$data->oracle_id;
        $this->idMtgo = @$data->mtgo_id;
        $this->idMtgoFoil = @$data->mtgo_foil_id;
        $this->idArena = @$data->arena_id;
        $this->idsMultiverse = @$data->multiverse_ids;

        $this->language = @$data->lang;
        $this->name = @$data->name;
        $this->printedName = @$data->printed_name;
        $this->type = @$data->type_line;
        $this->printedType = @$data->printed_type_line;
        $this->oracleText = @$data->oracle_text;
        $this->printedText = @$data->printed_text;
        $this->flavorText = @$data->flavor_text;
        $this->manaCost = @$data->mana_cost;
        $this->cmc = @$data->cmc;
        $this->colors = @$data->colors;
        $this->colorIdentity = @$data->color_identity;
        $this->colorIndicator = @$data->color_indicator;
        $this->number = @$data->collector_number;
        $this->rarity = @$data->rarity;
        $this->power = @$data->power;
        $this->toughness = @$data->tougness;
        $this->loyalty = @$data->loyalty;

        $this->set = @$data->set;
        $this->setName = @$data->set_name;

        $this->layout = @$data->layout;
        $this->frame = @$data->frame;
        $this->borderColor = @$data->border_color;
        $this->watermark = @$data->watermark;
        $this->artist = @$data->artist;

        $this->handModifier = @$data->hand_modifier;
        $this->lifeModifier = @$data->life_modifier;

        $this->isReserved = @$data->reserved;
        $this->isFoil = @$data->foil;
        $this->isNonFoil = @$data->nonfoil;
        $this->isReprint = @$data->reprint;
        $this->isOversized = @$data->oversized;
        $this->isDigital = @$data->digital;
        $this->isFullart = @$data->full_art;
        $this->isTimeshifted = @$data->timeshifted;
        $this->isColorshifted = @$data->colorshifted;
        $this->isFutureshifted = @$data->futureshifted;

        if(isset($data->card_faces)) {
            foreach($data->card_faces as $face) {
                $this->cardFaces[] = new CardFace($face, false);
            }
        }

        if(isset($data->legalities)) {
            $legalities = $data->legalities;

            $this->legalities = new \stdClass();
            $this->legalities->standard = $this->isLegal(@$legalities->standard);
            $this->legalities->modern = $this->isLegal(@$legalities->modern);
            $this->legalities->legacy = $this->isLegal(@$legalities->legacy);
            $this->legalities->vintage = $this->isLegal(@$legalities->vintage);
            $this->legalities->commander = $this->isLegal(@$legalities->commander);
            $this->legalities->pauper = $this->isLegal(@$legalities->pauper);
            $this->legalities->frontier = $this->isLegal(@$legalities->frontier);
            $this->legalities->brawl = $this->isLegal(@$legalities->brawl);
            $this->legalities->penny = $this->isLegal(@$legalities->penny);
            $this->legalities->future = $this->isLegal(@$legalities->future);
            $this->legalities->duel = $this->isLegal(@$legalities->duel);
            $this->legalities->{'1v1'} = $this->isLegal(@$legalities->{'1v1'});
        }

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

        if(isset($data->usd) || isset($data->eur) || isset($data->tix)) {
            $this->prices = new \stdClass();
            $this->prices->usd = @$data->usd;
            $this->prices->eur = @$data->eur;
            $this->prices->tix = @$data->tix;
        }

        if(isset($data->all_parts)) {
            foreach($data->all_parts as $part) {
                $related = new \stdClass();
                $related->object = @$part->object;
                $related->id = @$part->id;
                $related->name = @$part->name;

                $this->related[] = $related;
            }
        }
    }

    /**
     * @return ScryfallIterator
     */
    public function getFaces()
    {
        return new ScryfallIterator($this->cardFaces);
    }

    /**
     * @return ScryfallIterator
     */
    public function getRelated()
    {
        return new ScryfallIterator($this->related);
    }

    /**
     * @param $value
     * @return bool
     */
    private function isLegal($value)
    {
        return ($value === 'legal');
    }
}