<?php

declare (strict_types=1);

namespace Day9\Part1;

class Movement
{

    public string $direction;

    public int $distance;

    public function __construct(string $instruction){
        $instructionArray = explode(' ',$instruction);
        $this->direction  = $instructionArray[0];
        $this->distance   = (int) $instructionArray[1];
    }

}