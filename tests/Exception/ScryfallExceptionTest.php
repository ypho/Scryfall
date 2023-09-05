<?php

namespace Ypho\Scryfall\Tests\Exception;

use Ypho\Scryfall\Exception\ScryfallException;
use PHPUnit\Framework\TestCase;

class ScryfallExceptionTest extends TestCase
{
    public function testException()
    {
        $this->expectException(ScryfallException::class);
        $this->expectExceptionCode(123);
        $this->expectExceptionMessage('Error message');

        throw new ScryfallException('Error message', 123);
    }
}
