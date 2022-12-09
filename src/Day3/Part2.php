<?php

declare(strict_types=1);

namespace Day3;

class Part2
{
    public function solve($inputFile):int{
        $badgePriorities = 0;
        foreach (array_chunk(file($inputFile, FILE_IGNORE_NEW_LINES),3) as $elfGroup) {
            $elfGroup = array_map(fn($value): array => str_split($value), $elfGroup);
            $badge = implode(array_unique(array_intersect(...$elfGroup)));
            $badgePriorities += ctype_lower($badge)?ord($badge)-96:ord($badge)-64+26;
        }
        return $badgePriorities;
    }
}