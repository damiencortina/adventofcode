<?php

declare(strict_types=1);

namespace Day1;

class Part1
{
    public function solve($inputFile):int{
        foreach (explode("\n\n", file_get_contents($inputFile)) as $elfFood) {
            $elfCalories = array_sum(explode("\n", $elfFood));
            if ($elfCalories > ($mostCalories ?? 0)) $mostCalories = $elfCalories;
        }
        return ($mostCalories ?? 0);
    }
}