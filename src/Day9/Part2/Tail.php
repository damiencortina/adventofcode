<?php

declare (strict_types=1);

namespace Day9\Part2;

class Tail extends Knot
{

    private array $visitedPositions = [];

    public function follow(){
        parent::follow();
        $this->visitedPositions[] = [$this->x, $this->y];
    }

    public function getVisitedPositions(): array{
        return array_unique($this->visitedPositions, SORT_REGULAR);
    }

}