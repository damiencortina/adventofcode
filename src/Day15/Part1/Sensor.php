<?php

declare(strict_types=1);

namespace Day15\Part1;

class Sensor extends Device
{
    public Beacon $closestBeacon;

    public int $manhattanDistance;

    public function __construct(
        Cave   $cave,
        Beacon $closestBeacon,
        int    $x,
        int    $y
    )
    {
        parent::__construct($cave, $x, $y);
        $this->closestBeacon = $closestBeacon;
        $this->manhattanDistance = abs($this->closestBeacon->x - $this->x) + abs($this->closestBeacon->y - $this->y);
    }
}