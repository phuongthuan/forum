<?php

namespace Tests\Unit;

use App\Inspections\Spam;
use Tests\TestCase;

class SpamTest extends TestCase
{
    /** @test */
    public function it_check_for_validates_keyword()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply here'));

        $this->expectException('Exception');

        $spam->detect('yahoo customer support');
    }

    /** @test */
    public function it_check_for_helddown_keyword()
    {
        $spam = new Spam();

        $this->expectException('Exception');

        $spam->detect('Hello world aaaaaaaaaaaaa');
    }
}
