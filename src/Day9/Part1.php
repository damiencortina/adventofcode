<?php

declare(strict_types=1);

namespace Day9;

use Day9\Part1\Head;
use Day9\Part1\Tail;
use Day9\Part1\Movement;

class Part1{

    private Head $head;

    private Tail $tail;

    private array $tailPositionVisited;

    public function __construct() {
        $this->head = new Head();
        $this->tail = new Tail();
        $this->tailPositionVisited = [$this->tail->toArray()];
    }

    public function solve($inputFile):int{
        foreach($this->readInputFileLines($inputFile) as $inputFileLine) {
            $movement = new Movement($inputFileLine);
            for($i = 1; $i<=$movement->distance; $i++){
                $this->head->move($movement->direction);
                if($this->tail->shouldFollow($this->head)){
                    $this->tail->follow($this->head);
                    $this->tailPositionVisited[] = $this->tail->toArray();
                }
            }
        }
        return $this->filterUniqueTailPositionVisited();
    }

    private function readInputFileLines($inputFile): array{
        return explode("\n", file_get_contents($inputFile));
    }

    private function filterUniqueTailPositionVisited(): int {
        return count(array_unique($this->tailPositionVisited, SORT_REGULAR));
    }
    
}