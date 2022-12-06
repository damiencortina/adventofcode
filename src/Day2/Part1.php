<?php

declare(strict_types=1);

namespace Day2;

class Part1
{
    public function solve($inputFile):int{
        $points = 0;
        foreach (file($inputFile, FILE_IGNORE_NEW_LINES) as $match) {
            $matchArray = explode(" ",$match);
            $playerValue = ord($matchArray[1])-87;
            $elfValue = ord($matchArray[0])-64;
            if($playerValue === $elfValue+1 || $playerValue === $elfValue-2){
                $points += 6;
            }elseif($playerValue === $elfValue){
                $points += 3;
            }
            $points += $playerValue;
        }
        return $points;
    }
}