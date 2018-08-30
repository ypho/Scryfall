<?php

namespace Ypho\Scryfall\Exception;

class ScryfallException extends \Exception
{
    /**
     * ScryfallException constructor.
     * @param null $message
     * @param int $code
     */
    public function __construct($message = null, $code = 400)
    {
        $this->message = $message;
        $this->code = $code;
    }
}
