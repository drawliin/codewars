<?php

namespace Tests\Feature;

use Tests\TestCase;

require_once __DIR__ . '/../../storage/code/UserCode.php';

class ReverseTest extends TestCase
{
    /** @test */
    public function test_reverse_function_works()
    {
        $this->assertEquals("olleH", reverse("Hello"));
        $this->assertEquals("awihcinnoK", reverse("Konnichiwa"));
        
    }
}