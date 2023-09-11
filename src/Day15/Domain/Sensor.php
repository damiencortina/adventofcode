<?php

declare(strict_types=1);

namespace Day15\Domain;

class Sensor extends Device
{
    public Beacon $closestBeacon;

    public int $manhattanDistance;

    public function __construct(
        Beacon $closestBeacon,
        int    $x,
        int    $y
    )
    {
        parent::__construct($x, $y);
        $this->closestBeacon = $closestBeacon;
        $this->manhattanDistance = abs($this->closestBeacon->x - $this->x) + abs($this->closestBeacon->y - $this->y);
    }
}