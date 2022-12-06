<?php

declare(strict_types=1);

namespace Day2;

class Part2
{
    public function solve($inputFile):int{
        $points = 0;
        foreach (file($inputFile, FILE_IGNORE_NEW_LINES) as $match) {
            $matchArray = explode(" ",$match);
            $elfValue = ord($matchArray[0])-64;
            switch ($matchArray[1]) {
                case "X":
                    $points += 6-$elfValue - ( $elfValue % 3 + 1 );
                    break;
                case "Y":
                    $points += $elfValue + 3;
                    break;
                case "Z":
                    $points += $elfValue % 3 + 1 + 6;
                    break;
            }
        }
        return $points;
    }
}