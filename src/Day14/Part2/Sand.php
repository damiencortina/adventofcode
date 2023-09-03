<?php

declare(strict_types=1);

namespace Day14\Part2;

class Sand
{
    private const FALLING_SPEED = 1;
    private const LATERAL_SPEED = 1;
    public int $x;
    public int $y;
    public bool $isStable = false;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function move(Cave $cave): bool
    {
        if ($cave->positionIsAvailable($this->x, $this->y + self::FALLING_SPEED)) {
            $this->fall();
        } else {
            $this->roll($cave);
        }
        return $this->isStable;
    }

    public function fall(): void
    {
        $this->y += self::FALLING_SPEED;
    }

    public function roll(Cave $cave): void
    {
        if ($cave->positionIsAvailable($this->x - self::LATERAL_SPEED, $this->y + self::FALLING_SPEED)) {
            $this->fall();
            $this->x -= self::LATERAL_SPEED;
        } elseif ($cave->positionIsAvailable($this->x + self::LATERAL_SPEED, $this->y + self::FALLING_SPEED)) {
            $this->fall();
            $this->x += self::LATERAL_SPEED;
        } else {
            $this->isStable = true;
        }
    }

}