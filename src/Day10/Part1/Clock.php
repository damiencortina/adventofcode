<?php

declare(strict_types=1);

namespace Day10\Part1;

class Clock {

    private int $cycleCount = 0;

    public int $registerValue = 1;

    public int $totalSignalStrength = 0;

    public function tick(int $times): void
    {
        for($i = 0; $i<$times; $i++){
            $this->cycleCount++;
            if ($this->totalSignalStrengthMustBeRecalculated()) {
                $this->totalSignalStrength += $this->getCurrentSignalStrength();
            }
        }
    }

    private function totalSignalStrengthMustBeRecalculated():bool
    {
        return $this->cycleCount % 40 === 20 && $this->cycleCount <= 220;
    }

    private function getCurrentSignalStrength():int
    {
        return $this->cycleCount * $this->registerValue;
    }

}