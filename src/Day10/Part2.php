<?php

declare(strict_types=1);

namespace Day10;

use Day10\Part2\Clock;
use Day10\Part2\Screen;

class Part2{

    private Clock $clock;

    private Screen $screen;

    public function __construct(){
        $this->clock = new Clock();
        $this->screen = new Screen($this->clock);
    }

    public function solve(string $inputFile): string
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
        return $this->screen->output;
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
        $this->clock->tick(2, $this->screen);
        $this->clock->registerValue += $X;
    }

    private function noop(){
        $this->clock->tick(1, $this->screen);
    }
}