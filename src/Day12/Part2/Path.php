<?php

declare(strict_types=1);

namespace Day12\Part2;

class Path
{
    private array $squares = [];

    public Square $currentSquare;

    public function __construct(Square $square)
    {
        $this->addSquare($square);
    }

    public function passedBy(Square $square): bool
    {
        return in_array($square, $this->squares);
    }

    public function addSquare(Square $square): void
    {
        $this->currentSquare = $square;
        $this->squares[] = $this->currentSquare;
    }

    public function getLength(): int
    {
        return count($this->squares);
    }

}