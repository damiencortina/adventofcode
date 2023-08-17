<?php

declare(strict_types=1);

namespace Day11;

use Day11\Part2\KeepAway;

class Part2
{
    public function solve(string $inputFile): int
    {
        $keepAway = new KeepAway($inputFile);
        return $keepAway->getMonkeyBusiness();
    }

}