<?php

namespace Tests\Feature;

use Tests\TestCase;
require_once __DIR__ . '/../../storage/code/UserCode.php';


class AddTest extends TestCase
{
    /** @test */
    public function test_add_function_works()
    {
        $this->assertEquals(5, add(2, 3));
        $this->assertEquals(0, add(-1, 1));
        $this->assertEquals(10, add(40, 60));
    }
}
