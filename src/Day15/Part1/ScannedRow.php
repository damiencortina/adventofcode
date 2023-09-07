<?php

declare(strict_types=1);

namespace Day15\Part1;

class ScannedRow
{
    public array $range = [];
    public array $unknownRanges = [];
    private int $numberOfDevicesOnThisRow = 0;

    public function __construct(
        private readonly int   $y,
        private readonly array $sensors
    )
    {
        /** @var Sensor $sensor */
        foreach ($this->sensors as $sensor) {
            if ($sensor->y === $y) {
                $this->numberOfDevicesOnThisRow++;
            }
            if ($this->isCrossingSensorArea($sensor)) {
                $sensorDistanceToRow = abs($sensor->y - $y);
                $manhattanDistanceRemaining = $sensor->manhattanDistance - $sensorDistanceToRow;
                $currentEmptyPositionsInterval = [$sensor->x - $manhattanDistanceRemaining, $sensor->x + $manhattanDistanceRemaining];
                if (empty($this->range)) {
                    $this->range = $currentEmptyPositionsInterval;
                } else {
                    $this->checkLeft($currentEmptyPositionsInterval);
                    $this->checkRight($currentEmptyPositionsInterval);
                }
            }
        }
    }

    public function getScannedPositions()
    {
        return $this->range[1] - $this->range[0] - $this->getUnknownsPositionsCount() - $this->numberOfDevicesOnThisRow;
    }

    public function getUnknownsPositionsCount()
    {
        $unknownPositionsCount = 0;
        foreach ($this->unknownRanges as $unknownRange) {
            $unknownPositionsCount += $unknownRange[1] - $unknownRange[0];
        }
        return $unknownPositionsCount;
    }

    private function isCrossingSensorArea(Sensor $sensor): bool
    {
        return ($sensor->y > $this->y && $sensor->y - $sensor->manhattanDistance < $this->y)
            || ($sensor->y < $this->y && $sensor->y + $sensor->manhattanDistance > $this->y);
    }

    private function checkLeft(array $currentEmptyPositionsInterval): void
    {
        if ($this->range[0] > $currentEmptyPositionsInterval[0]) {
            if ($this->range[0] > $currentEmptyPositionsInterval[1]) {
                $this->unknownRanges[] = [$currentEmptyPositionsInterval[1], $this->range[0]];
            }
            $this->range[0] = $currentEmptyPositionsInterval[1];
        }
    }

    private function checkRight(array $currentEmptyPositionsInterval): void
    {
        if ($this->range[1] < $currentEmptyPositionsInterval[1]) {
            if ($this->range[1] < $currentEmptyPositionsInterval[0]) {
                $this->unknownRanges[] = [$this->range[1], $currentEmptyPositionsInterval[0]];
            }
            $this->range[1] = $currentEmptyPositionsInterval[1];
        }
    }
}