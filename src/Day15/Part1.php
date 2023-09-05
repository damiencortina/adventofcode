<?php

declare(strict_types=1);

namespace Day15;

use Day15\Part1\Cave;

class Part1
{

    public function solve(string $inputFile): int
    {
        $cave = new Cave($inputFile);
        return $cave->getPositionsThatCannotContainTheBeacon();
    }

}