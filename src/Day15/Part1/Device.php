<?php

declare(strict_types=1);

namespace Day15\Part1;

abstract class Device
{
    public int $x;

    public int $y;

    public function __construct(Cave $cave, int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
        if ($this->y === Cave::ROW) $cave->beaconAndSensorsPositionsToOmit++;
    }
}