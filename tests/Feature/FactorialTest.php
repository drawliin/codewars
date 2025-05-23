<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ChallengeRunner;

require_once __DIR__ . '/../../storage/code/UserCode.php';

class FactorialTest extends TestCase
{
    /** @test */
    public function test_factorial_works()
    {
        $this->assertEquals(1, factorial(0));
        
    }
    /** @test */
    public function test_factorial_works_1()
    {
        
        $this->assertEquals(120, factorial(5));
    }
    /** @test */
    public function test_factorial_works_2()
    {
        $this->assertEquals(1, factorial(1));
       
    }
    /** @test */
    public function test_factorial_works_3()
    {
        
        $this->assertEquals(2, factorial(2));
        
    }
    /** @test */
    public function test_factorial_works_4()
    {
        
        $this->assertEquals(6, factorial(3));
        
    }
    /** @test */
    public function test_factorial_works_5()
    {
        
        $this->assertEquals(24, factorial(4));
    }
}
