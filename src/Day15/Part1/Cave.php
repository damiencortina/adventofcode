<?php

declare(strict_types=1);

namespace Day15\Part1;

class Cave
{
    private array $sensors = [];

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
                $beacon = new Beacon(...$beaconData);
                $beacons[$beaconId] = $beacon;
            }
            $this->sensors[] = new Sensor($beacon, ...$sensorData);
        }
        usort($this->sensors, fn(Sensor $a, Sensor $b) => $a->x > $b->x);
    }

    public function scanRow(int $row): ScannedRow
    {
        return new ScannedRow($row, $this->sensors);
    }
}