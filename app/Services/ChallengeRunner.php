<?php 
namespace App\Services;

class ChallengeRunner
{

    public static function add($a, $b)
    {
        return $a + $b; // User solution
    }

    public static function reverse($str){
        return strrev($str);
    }

    public static function factorial($n)
    {
        if ($n <= 1) return 1;
        return $n * factorial($n - 1);
    }

}
