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
        usort($this->sensors,
            fn(Sensor $a, Sensor $b) => $a->x - $a->manhattanDistance > $b->x - $b->manhattanDistance);
        //TODO: sorting is probably useless and won't prevent problems of wrongly considered unknown spaces
    }

    public function scanRow(int $row): ScannedRow
    {
        return new ScannedRow($row, $this->sensors);
    }


    public function getDistressBeaconPosition(int $researchPerimeterSize): array
    {
        foreach (range(0, $researchPerimeterSize) as $row) {
            $scannedRow = $this->scanRow($row);
            if (!empty($scannedRow->unknownRanges)) {
                foreach ($scannedRow->unknownRanges as $unknownRange) {
                    if ($unknownRange[0] > 0 && $unknownRange[1] < $researchPerimeterSize) {
                        return [($unknownRange[1] + $unknownRange[0]) / 2, $row];
                    }
                }
            }
            if ($scannedRow->range[0] > 0) {
                return [0, $row];
            }
            if ($scannedRow->range[1] < $researchPerimeterSize) {
                return [$researchPerimeterSize, $row];
            }
        }
        return [0, 0]; //TODO : clean that
    }
}