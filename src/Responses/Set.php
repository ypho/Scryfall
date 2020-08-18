<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;
use Ypho\Scryfall\Client;

/**
 * Class Set
 * @package Scryfall\Responses
 */
class Set extends Base
{
    /** @var string */
    public $object;

    /** @var string */
    public $parent;

    /** @var string */
    public $code;

    /** @var string */
    public $mtgoCode;

    /** @var string */
    public $name;

    /** @var string */
    public $release;

    /** @var string */
    public $setType;

    /** @var string */
    public $block;

    /** @var string */
    public $blockCode;

    /** @var int */
    public $cardCount;

    /** @var bool */
    public $digitalOnly;

    /** @var bool */
    public $foilOnly;

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

        $this->object = @$data->object;
        $this->parent = @$data->parent_set_code;
        $this->code = @$data->code;
        $this->mtgoCode = @$data->mtgo_code;
        $this->name = @$data->name;
        $this->release = @$data->released_at;
        $this->setType = @$data->set_type;
        $this->block = @$data->block;
        $this->blockCode = @$data->block_code;
        $this->cardCount = @$data->card_count;
        $this->digitalOnly = @$data->digital;
        $this->foilOnly = @$data->foil_only;
    }

    /**
     * @param Client $client
     * @return Cards
     * @throws \Ypho\Scryfall\Exception\ScryfallException
     */
    public function getCards(Client $client)
    {
        return $client->cards()->search('set:' . $this->code, 'prints', 'set');
    }
}
