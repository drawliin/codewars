<?php

namespace Tests\Feature;

use Tests\TestCase;
require_once __DIR__ . '/../../storage/code/UserCode.php';


class First_non_repeating_charTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */
    public function test_non_repeating_car_1()
    {
        $this->assertEquals('w', firstNonRepeatingChar('swiss'));
        
    }
    
    /** @test */
    public function test_non_repeating_car_2()
    {
        
        $this->assertEquals(null, firstNonRepeatingChar('aabbcc'));
        
    }
    /** @test */
    public function test_non_repeating_car_3()
    {
        
        $this->assertEquals('c', firstNonRepeatingChar('aAbBc'));
        
    }
    /** @test */
    public function test_non_repeating_car_4()
    {
        
        $this->assertEquals(null, firstNonRepeatingChar(''));
       
    }
    /** @test */
    public function test_non_repeating_car_5()
    {
        
        $this->assertEquals('^', firstNonRepeatingChar('!@#!!@#^&*'));
    }

    /** @test */
    public function test_non_repeating_car_7()
    {
    
        $this->assertEquals('a', firstNonRepeatingChar('abcde'));
    }
}
