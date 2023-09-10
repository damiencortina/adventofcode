<?php

declare(strict_types=1);

namespace Day15\Part1;

class ScannedRow
{
    public ?array $range = null;
    public array $unknownRanges = [];
    private int $numberOfDevicesOnThisRow = 0;

    public function __construct(
        private readonly int   $y,
        private readonly array $sensors,
        int                    $from = null,
        int                    $to = null
    )
    {
        $scannedRanges = [];
        /** @var Sensor $sensor */
        foreach ($this->sensors as $sensor) {
            if ($sensor->y === $y) {
                $this->numberOfDevicesOnThisRow++;
            }
            if ($this->isCrossingSensorArea($sensor)) {
                $sensorDistanceToRow = abs($sensor->y - $y);
                $manhattanDistanceRemaining = $sensor->manhattanDistance - $sensorDistanceToRow;
                $scannedRanges[] = [$sensor->x - $manhattanDistanceRemaining, $sensor->x + $manhattanDistanceRemaining];
            }
        }
        usort($scannedRanges, fn(array $a, array $b) => $a[0] > $b[0]);
        foreach ($scannedRanges as $scannedRange) {
            if (!isset($from) || $scannedRange[1] >= $from) {
                if (!isset($this->range)) {
                    $this->range = $scannedRange;
                }
                if ($this->range[1] < $scannedRange[1]) {
                    if ($this->range[1] + 1 < $scannedRange[0]) {
                        $this->unknownRanges[] = [$this->range[1], $scannedRange[0]];
                    }
                    $this->range[1] = $scannedRange[1];
                    if (isset($to) && $this->range[1] >= $to) break;
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
        return ($sensor->y > $this->y && $sensor->y - $sensor->manhattanDistance <= $this->y)
            || ($sensor->y < $this->y && $sensor->y + $sensor->manhattanDistance >= $this->y)
            || $sensor->y === $this->y;
    }
}