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
        $emptyPositions = 0;
        $positionsThatCannotContainTheBeacon = [];
        /** @var Sensor $sensor */
        foreach ($this->sensors as $sensor) {
            if ($this->rowIsCrossingSensorArea($sensor)) {
                $distance = abs($sensor->y - self::ROW);
                $manhattanDistanceRemaining = $sensor->manhattanDistance - $distance;
                $localPositionsThatCannotContainTheBeacon = [$sensor->x - $manhattanDistanceRemaining, $sensor->x + $manhattanDistanceRemaining];
                if (empty($positionsThatCannotContainTheBeacon)) {
                    $positionsThatCannotContainTheBeacon = $localPositionsThatCannotContainTheBeacon;
                } else {
                    if ($positionsThatCannotContainTheBeacon[1] < $localPositionsThatCannotContainTheBeacon[1]) {
                        if ($positionsThatCannotContainTheBeacon[1] < $localPositionsThatCannotContainTheBeacon[0]) {
                            $emptyPositions += $localPositionsThatCannotContainTheBeacon[0] - $positionsThatCannotContainTheBeacon[1];
                        }
                        $positionsThatCannotContainTheBeacon[1] = $localPositionsThatCannotContainTheBeacon[1];
                    }
                    if ($positionsThatCannotContainTheBeacon[0] > $localPositionsThatCannotContainTheBeacon[0]) {
                        if ($positionsThatCannotContainTheBeacon[0] > $localPositionsThatCannotContainTheBeacon[1]) {
                            $emptyPositions += $positionsThatCannotContainTheBeacon[0] - $localPositionsThatCannotContainTheBeacon[1];
                        }
                        $positionsThatCannotContainTheBeacon[0] = $localPositionsThatCannotContainTheBeacon[0];
                    }
                }
            }
        }
        return $positionsThatCannotContainTheBeacon[1] - $positionsThatCannotContainTheBeacon[0] - $emptyPositions;
    }

    private function rowIsCrossingSensorArea(Sensor $sensor): bool
    {
        return ($sensor->y > self::ROW && $sensor->y - $sensor->manhattanDistance < self::ROW)
            || ($sensor->y < self::ROW && $sensor->y + $sensor->manhattanDistance > self::ROW);
    }
}