<?php

declare(strict_types=1);

namespace Day14;

use Day14\Part1\Cave;

class Part1
{

    public function solve(string $inputFile): int
    {
        $cave = new Cave($inputFile);
        return $cave->pourSable();
    }

}