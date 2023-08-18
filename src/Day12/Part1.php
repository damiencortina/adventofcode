<?php

declare(strict_types=1);

namespace Day12;

use Day12\Part1\Map;

class Part1
{

    public function solve(string $inputFile): int
    {
        $map = new Map($inputFile);
        return $map->findTheShortestPath();
    }

}