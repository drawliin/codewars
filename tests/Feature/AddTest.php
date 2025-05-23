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
        
    }
    /** @test */
    public function test_add_function_works_two()
    {
        $this->assertEquals(0, add(-1, 1));
    }
    /** @test */
    public function test_add_function_works_three()
    {
        $this->assertEquals(100, add(40, 60));
    }
}









// namespace Tests\Feature;

// use Tests\TestCase;
// require_once __DIR__ . '/../../storage/code/UserCode.php';


// class AddTest extends TestCase
// {
//     /** @test */
//     public function test_add_function_works()
//     {
//         $this->checkEquals(4, add(2, 3), 'add(2, 3) should return 5');
//         $this->checkEquals(0, add(-1, 1), 'add(-1, 1) should return 0');
//         $this->checkEquals(10, add(40, 60), 'add(40, 60) should return 100');
//     }

//     private function checkEquals($expected, $actual, $message)
//     {
//         if ($expected === $actual) {
//             echo " $message : ✓ $actual\n";
//         } else if ($actual == null){
//             echo " $message : ⨯ Null\n";
//         } else{
//             echo " $message : ⨯ $actual\n";
//         }
//     }
// }
