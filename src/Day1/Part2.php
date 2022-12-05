<?php

declare(strict_types=1);

namespace Day1;

class Part2
{
    public function solve($inputFile):int{
        $elvesCalories = [];
        foreach (explode("\n\n", file_get_contents($inputFile)) as $elfFood) {
            $elvesCalories[] = array_sum(explode("\n",$elfFood));
        }
        rsort($elvesCalories);
        return array_sum(array_slice($elvesCalories, 0, 3));
    }
}