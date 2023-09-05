<?php

namespace Ypho\Scryfall\Tests\Objects;

use Ypho\Scryfall\Objects\ManaCost;
use PHPUnit\Framework\TestCase;

class ManaCostTest extends TestCase
{
    public function testManaCost()
    {
        $manaCost = file_get_contents(__DIR__ . '/../../examples/json/mana_cost.json');
        $mana = ManaCost::createFromApi(json_decode($manaCost, true));

        $this->assertInstanceOf(ManaCost::class, $mana);
        $this->assertEquals('{X}{U}{R}', $mana->getCost());
        $this->assertCount(2, $mana->getColors());
        $this->assertContains('U', $mana->getColors());
        $this->assertContains('R', $mana->getColors());
        $this->assertEquals(2, $mana->getCmc());
        $this->assertFalse($mana->isColorless());
        $this->assertFalse($mana->isMonoColored());
        $this->assertTrue($mana->isMultiColored());
    }
}
