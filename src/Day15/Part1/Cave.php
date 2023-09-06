<?php

declare(strict_types=1);

namespace Day15\Part1;

class Cave
{
    const ROW = 2000000;
    private array $sensors = [];
    public int $beaconAndSensorsPositionsToOmit = 0;

    public function __construct(string $inputFileName)
    {
        $beacons = [];
        foreach (file($inputFileName) as $sensorsReadings) {
            $datas = explode(': ', $sensorsReadings);
            $sensorData = str_replace('Sensor at x=', '', $datas[0]);
            $sensorData = str_replace('y=', '', $sensorData);
            $sensorData = json_decode("[$sensorData]");
            $beaconData = str_replace('closest beacon is at x=', '', $datas[1]);
            $beaconData = str_replace('y=', '', $beaconData);
            $beaconData = json_decode("[$beaconData]");
            $beaconId = array_sum($beaconData);
            if (array_key_exists($beaconId, $beacons)) {
                $beacon = $beacons[$beaconId];
            } else {
                $beacon = new Beacon($this, ...$beaconData);
                $beacons[$beaconId] = $beacon;
            }
            $this->sensors[] = new Sensor($this, $beacon, ...$sensorData);
        }
        usort($this->sensors, fn(Sensor $a, Sensor $b) => $a->x > $b->x);
    }

    public function getPositionsThatCannotContainTheBeacon(): int
    {
        $unknownPositions = 0;
        $emptyPositionsInterval = [];
        /** @var Sensor $sensor */
        foreach ($this->sensors as $sensor) {
            if ($this->rowIsCrossingSensorArea($sensor)) {
                $sensorDistanceToRow = abs($sensor->y - self::ROW);
                $manhattanDistanceRemaining = $sensor->manhattanDistance - $sensorDistanceToRow;
                $currentEmptyPositionsInterval = [$sensor->x - $manhattanDistanceRemaining, $sensor->x + $manhattanDistanceRemaining];
                if (empty($emptyPositionsInterval)) {
                    $emptyPositionsInterval = $currentEmptyPositionsInterval;
                } else {
                    $emptyPositionsInterval[0] = $this->checkLeft($emptyPositionsInterval[0], $currentEmptyPositionsInterval, $unknownPositions);
                    $emptyPositionsInterval[1] = $this->checkRight($emptyPositionsInterval[1], $currentEmptyPositionsInterval, $unknownPositions);
                }
            }
        }
        return $emptyPositionsInterval[1] - $emptyPositionsInterval[0] - $unknownPositions;
    }

    private function checkLeft(int $emptyPositionsEndingIndex, array $currentEmptyPositionsInterval, int &$emptyPositions)
    {
        if ($emptyPositionsEndingIndex > $currentEmptyPositionsInterval[0]) {
            if ($emptyPositionsEndingIndex > $currentEmptyPositionsInterval[1]) {
                $emptyPositions += $emptyPositionsEndingIndex - $currentEmptyPositionsInterval[1];
            }
            return $currentEmptyPositionsInterval[0];
        } else {
            return $emptyPositionsEndingIndex;
        }
    }

    private function checkRight(int $emptyPositionsStartingIndex, array $currentEmptyPositionsInterval, int &$emptyPositions)
    {
        if ($emptyPositionsStartingIndex < $currentEmptyPositionsInterval[1]) {
            if ($emptyPositionsStartingIndex < $currentEmptyPositionsInterval[0]) {
                $emptyPositions += $currentEmptyPositionsInterval[0] - $emptyPositionsStartingIndex;
            }
            return $currentEmptyPositionsInterval[1];
        } else {
            return $emptyPositionsStartingIndex;
        }
    }

    private function rowIsCrossingSensorArea(Sensor $sensor): bool
    {
        return ($sensor->y > self::ROW && $sensor->y - $sensor->manhattanDistance < self::ROW)
            || ($sensor->y < self::ROW && $sensor->y + $sensor->manhattanDistance > self::ROW);
    }
}