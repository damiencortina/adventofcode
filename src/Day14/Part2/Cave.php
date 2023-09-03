<?php

declare(strict_types=1);

namespace Day14\Part2;

class Cave
{
    const SAND_STARTING_X = 500;
    const SAND_STARTING_Y = 0;
    private array $map = [];
    private int $lowestPosition = 0;
    private int $highestStartingPosition = self::SAND_STARTING_Y;

    // TODO : refactor and simplify construction
    public function __construct(
        string $inputFile
    )
    {
        foreach (file($inputFile) as $inputFileLine) {
            $rockPath = explode(' -> ', $inputFileLine);
            foreach ($rockPath as $rockPathAngle) {
                $rockPathAngle = json_decode("[$rockPathAngle]");
                if (isset($lastRockPathAngle)) {
                    if ($lastRockPathAngle[0] === $rockPathAngle[0]) { // X remains the same, Y will vary
                        $range = range($lastRockPathAngle[1], $rockPathAngle[1]);
                        $x = $rockPathAngle[0];
                        foreach ($range as $y) {
                            if ($y > $this->lowestPosition) $this->lowestPosition = $y;
                            $this->map[$x][$y] = '#';
                        }
                    } else { // X will vary, Y remains the same
                        $range = range($lastRockPathAngle[0], $rockPathAngle[0]);
                        $y = $rockPathAngle[1];
                        foreach ($range as $x) {
                            $this->map[$x][$y] = '#';
                        }
                        if ($y > $this->lowestPosition) $this->lowestPosition = $y;
                    }
                }
                $lastRockPathAngle = $rockPathAngle;
            }
            unset($lastRockPathAngle);
        }
        $this->lowestPosition += 2;
    }

    public function positionIsAvailable(int $x, int $y): bool
    {
        return !(array_key_exists($x, $this->map) && array_key_exists($y, $this->map[$x])) && $y < $this->lowestPosition;
    }

    public function pourSable(): int
    {
        $sandParticlesCount = 0;
        $caveIsFull = false;
        while (!$caveIsFull) {
            $sand = new Sand(self::SAND_STARTING_X, $this->highestStartingPosition);
            $stable = false;
            while (!$stable) {
                $stable = $sand->move($this);
                if ($stable) {
                    if ($sand->x === self::SAND_STARTING_X && $sand->y === self::SAND_STARTING_Y) $caveIsFull = true;
                    $sandParticlesCount++;
                }
            }
            $this->map[$sand->x][$sand->y] = $sand;
            if ($sand->y < $this->highestStartingPosition && $sand->x === self::SAND_STARTING_X) {
                $this->highestStartingPosition = $sand->y;
            }
        }
        return $sandParticlesCount;
    }

}