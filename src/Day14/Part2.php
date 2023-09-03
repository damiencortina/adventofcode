<?php

declare(strict_types=1);

namespace Day14;

use Day14\Part2\Cave;

class Part2
{

    public function solve(string $inputFile): int
    {
        $cave = new Cave($inputFile);
        return $cave->pourSable();
    }

}