<?php

declare(strict_types=1);

namespace Day15;

use Day15\Part1\Cave;

class Part2
{

    public function solve(string $inputFile): int
    {
        $cave = new Cave($inputFile);
        $distressBeaconPosition = $cave->getDistressBeaconPosition(4000000);
        return $distressBeaconPosition[0] * 4000000 + $distressBeaconPosition[1];
    }

}