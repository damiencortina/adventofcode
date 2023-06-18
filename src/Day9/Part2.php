<?php

declare(strict_types=1);

namespace Day9;

use Day9\Part2\Head;
use Day9\Part2\Knot;
use Day9\Part2\Tail;
use Day9\Part2\Movement;

class Part2
{

    private Head $head;

    private Tail $tail;

    private $knotsCount = 10;

    public function __construct(){
        $this->head = new Head();
        $previousKnot = $this->head;
        for($i = 0; $i<$this->knotsCount-2; $i++){
            $previousKnot = (new Knot())->setPreviousKnot($previousKnot??$this->head);
        }
        $this->tail = new Tail();
        $this->tail->setPreviousKnot($previousKnot);
    }

   public function solve(string $inputFile):int{
        foreach  ($this->readInputFileLines($inputFile) as $inputFileLine){
            $movement = new Movement($inputFileLine);
            for($i = 1; $i<=$movement->distance; $i++){
                $this->head->move($movement->direction);
            }
        }
        return count($this->tail->getVisitedPositions());
    }

    private function readInputFileLines($inputFile): array{
        return explode("\n", file_get_contents($inputFile));
    }
    
}