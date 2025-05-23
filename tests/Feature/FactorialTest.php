<?php

namespace Tests\Feature;

use Tests\TestCase;

require_once __DIR__ . '/../../storage/code/UserCode.php';

class FactorialTest extends TestCase
{
    /** @test */
    public function test_factorial_works()
    {
        $this->assertEquals(1, factorial(0));
        $this->assertEquals(1, factorial(1));
        $this->assertEquals(2, factorial(2));
        $this->assertEquals(6, factorial(3));
        $this->assertEquals(24, factorial(4));
        $this->assertEquals(120, factorial(5));
    }
}
