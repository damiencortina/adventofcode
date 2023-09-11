<?php

declare(strict_types=1);

namespace Day15;

use Day15\Domain\Cave;

class Part1
{

    public function solve(string $inputFile): int
    {
        $cave = new Cave($inputFile);
        $scannedRow = $cave->scanRow(2000000);
        return $scannedRow->getScannedPositions();
    }

}