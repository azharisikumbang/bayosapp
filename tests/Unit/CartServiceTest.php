<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CartServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_contents()
    {
        dd(\Cart::getContent());
    }
}
