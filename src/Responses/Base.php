<?php

namespace Ypho\Scryfall\Responses;

use GuzzleHttp\Psr7\Response;

class Base
{
    /** @var int */
    protected $statusCode;

    /** @var string */
    protected $message;

    /** @var bool */
    protected $hasError = false;

    /** @var string */
    protected $errorMessage;

    /** @var int */
    private $count;

    /** @var int */
    private $total;

    /** @var bool */
    private $hasMore = false;

    /**
     * Base constructor.
     * @param Response $data
     * @param bool $initialize
     */
    public function __construct($data = null, $initialize = true)
    {
        if ($initialize) {
            $this->statusCode = @$data->getStatusCode();
            $this->message = @$data->getReasonPhrase();

            if ($this->statusCode >= 400) {
                $this->hasError = true;
            } else {
                unset($this->errorMessage);
            }
        } else {
            unset($this->statusCode);
            unset($this->message);
            unset($this->hasError);
            unset($this->errorMessage);
        }
    }

    /**
     * @param int $count
     * @param int $total
     * @param bool $hasMore
     */
    protected function setCollectionData(int $count, int $total = 0, bool $hasMore = false)
    {
        $this->count = $count;
        $this->total = $total;

        if ($hasMore && $this->total > 0 && $this->count > 0) {
            $this->hasMore = true;
        } else {
            $this->hasMore = false;
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function total()
    {
        return $this->total;
    }

    /**
     * @return bool
     */
    public function hasMore()
    {
        return $this->hasMore;
    }
}
