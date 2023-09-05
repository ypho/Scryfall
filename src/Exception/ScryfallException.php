<?php

namespace Ypho\Scryfall\Exception;

class ScryfallException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code = 400)
    {
        parent::__construct();

        $this->message = $message;
        $this->code = $code;
    }
}
