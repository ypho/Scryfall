<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;

/**
 * Class Ruling
 * @package Scryfall\Responses
 */
class Ruling extends Base
{
    /** @var string */
    public $object;

    /** @var string */
    public $source;

    /** @var string */
    public $published;

    /** @var string */
    public $comment;

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
        $this->source = @$data->source;
        $this->published = @$data->published_at;
        $this->comment = @$data->comment;
    }
}