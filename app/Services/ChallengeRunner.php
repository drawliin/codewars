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
        return $n * self::factorial($n - 1);
    }

    public function firstNonRepeatingChar($str) {
        $charCount = [];
        $length = mb_strlen($str);
        $lowerStr = mb_strtolower($str);

        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($lowerStr, $i, 1);
            $charCount[$char] = ($charCount[$char] ?? 0) + 1;
        }

        for ($i = 0; $i < $length; $i++) {
            $charLower = mb_substr($lowerStr, $i, 1);
            if ($charCount[$charLower] === 1) {
                return mb_substr($str, $i, 1);
            }
        }

        return null;
    }

}
