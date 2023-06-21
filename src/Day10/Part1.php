<?php

declare(strict_types=1);

namespace Day10;

use Day10\Part1\Clock;

class Part1{

    private Clock $clock;

    public function __construct(){
        $this->clock = new Clock();
    }

    public function solve(string $inputFile): int
    {
        foreach ($this->readInputFileLines($inputFile) as $inputFileLine){
            $instruction = $this->readInstruction($inputFileLine);
            if($this->isAddX($instruction)){
                $X = (int) $instruction[1];
                $this->addX($X);
            }else{
                $this->noop();
            }
        }
        return $this->clock->totalSignalStrength;
    }

    private function readInputFileLines(string $inputFile): array
    {
        return explode("\n", file_get_contents($inputFile));
    }

    private function readInstruction(string $inputFileLine): array
    {
        return explode(' ', $inputFileLine);
    }

    private function isAddX(array $instruction): bool
    {
        return count($instruction) === 2;
    }

    private function addX(int $X){
        $this->clock->tick(2);
        $this->clock->registerValue += $X;
    }

    private function noop(){
        $this->clock->tick(1);
    }
}