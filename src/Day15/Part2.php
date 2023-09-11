<?php

declare(strict_types=1);

namespace Day15;

use Day15\Domain\Cave;
use Exception;

class Part2
{

    public function solve(string $inputFile): int
    {
        $cave = new Cave($inputFile);
        try {
            $distressBeaconPosition = $cave->getDistressBeaconPosition(4000000);
        } catch (Exception $exception) {
            echo $exception->getMessage() . "\n";
            die;
        }
        return $distressBeaconPosition[0] * 4000000 + $distressBeaconPosition[1];
    }

}