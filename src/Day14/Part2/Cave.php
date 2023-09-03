<?php

declare(strict_types=1);

namespace Day14\Part2;

class Cave
{
    const SAND_STARTING_X = 500;
    const SAND_STARTING_Y = 0;
    const X = 0;
    const Y = 1;
    private array $map = [];
    private int $lowestPosition = 0;
    private int $highestStartingPosition = self::SAND_STARTING_Y;

    public function __construct(
        string $inputFile
    )
    {
        foreach (file($inputFile) as $inputFileLine) {
            $rockPath = explode(' -> ', $inputFileLine);
            foreach ($rockPath as $endOfWall) {
                $endOfWall = json_decode("[$endOfWall]");
                if (isset($startOfWall)) {
                    if ($startOfWall[self::X] === $endOfWall[self::X]) { // X remains the same, Y will vary
                        $x = $endOfWall[self::X];
                        foreach (range($startOfWall[self::Y], $endOfWall[self::Y]) as $y) {
                            if ($y > $this->lowestPosition) $this->lowestPosition = $y;
                            $this->map[$x][$y] = '#';
                        }
                    } else { // X will vary, Y remains the same
                        $y = $endOfWall[self::Y];
                        foreach (range($startOfWall[self::X], $endOfWall[self::X]) as $x) {
                            $this->map[$x][$y] = '#';
                        }
                        if ($y > $this->lowestPosition) $this->lowestPosition = $y;
                    }
                }
                $startOfWall = $endOfWall;
            }
            unset($startOfWall);
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