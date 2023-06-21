<?php

declare(strict_types=1);

namespace Day10\Part2;

class Clock {

    public int $cycleCount = 0;

    public int $registerValue = 1;

    public function tick(int $times, Screen $screen): void
    {
        for($i = 0; $i<$times; $i++){
            $this->cycleCount++;
            $screen->draw();
        }
    }

}