<?php

declare(strict_types=1);

namespace Day12\Part1;

class Square
{
    private const STARTING_LETTER = 'S';
    private const ENDING_LETTER = 'E';

    public int $x;

    public int $y;

    public string $letter;

    public int $height;

    public array $accessibleSquares = [];

    public bool $alreadyVisitedBySomePath = false;

    public function __construct(
        int    $x,
        int    $y,
        string $letter
    )
    {
        $this->x = $x;
        $this->y = $y;
        $this->letter = $letter;
        $this->height = match ($letter) {
            'S' => 1,
            'E' => 26,
            default => ord($letter) - 96,
        };
    }

    public function addAccessibleSquare(Square $square): void
    {
        $this->accessibleSquares[] = $square;
    }

    public function givesAccessTo(Square $square): bool
    {
        return $square->height <= $this->height + 1;
    }

    public function isTheStartingSquare(): bool
    {
        return $this->letter === self::STARTING_LETTER;
    }

    public function isTheEndingSquare(): bool
    {
        return $this->letter === self::ENDING_LETTER;
    }
}