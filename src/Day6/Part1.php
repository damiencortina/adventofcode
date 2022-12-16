<?php

declare(strict_types=1);

namespace Day6;

class Part1
{

    public function solve($inputFile): int{
        $dataStreamArray = str_split(file_get_contents($inputFile));
        $i = 0;
        while(!($found??false)){
            count(array_unique(array_slice($dataStreamArray, $i, 4))) === 4 ? $found = true : $i++;
        }
        return $i + 4;
    }

}