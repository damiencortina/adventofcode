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
    }

    public function getPositionsThatCannotContainTheBeacon(): int
    {
        $positionsThatCannotContainTheBeacon = [];
        /** @var Sensor $sensor */
        foreach ($this->sensors as $sensor) {
            if (in_array(self::ROW, range($sensor->y - $sensor->manhattanDistance, $sensor->y))) {
                $distance = $sensor->y - self::ROW;
            } elseif (in_array(self::ROW, range($sensor->y, $sensor->y + $sensor->manhattanDistance))) {
                $distance = self::ROW - $sensor->y;
            } else {
                continue;
            }
            $manhattanDistanceRemaining = $sensor->manhattanDistance - $distance;
            $localPositionsThatCannotContainTheBeacon =
                range($sensor->x - $manhattanDistanceRemaining, $sensor->x + $manhattanDistanceRemaining);
            $positionsThatCannotContainTheBeacon =
                array_merge($positionsThatCannotContainTheBeacon, $localPositionsThatCannotContainTheBeacon);
        }
        return count(array_unique($positionsThatCannotContainTheBeacon)) - $this->beaconAndSensorsPositionsToOmit;
    }
}