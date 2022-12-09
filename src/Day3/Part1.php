<?php

declare(strict_types=1);

namespace Day3;

class Part1
{
    public function solve($inputFile):int{
        $commonItemsPriorities = 0;
        foreach (file($inputFile, FILE_IGNORE_NEW_LINES) as $rucksack) {
            $rucksackItems = str_split($rucksack);
            $rucksackCompartments = array_chunk($rucksackItems, count($rucksackItems)/2);
            $commonItem = implode(array_intersect($rucksackCompartments[0], $rucksackCompartments[1]));
            $commonItemsPriorities += ctype_lower($commonItem)?ord($commonItem)-96:ord($commonItem)-64+26;
        }
        return $commonItemsPriorities;
    }
}