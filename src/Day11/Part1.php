<?php

declare(strict_types=1);

namespace Day11;

use Day11\Part1\KeepAway;

class Part1
{
    public function solve(string $inputFile): int
    {
        $keepAway = new KeepAway($inputFile);
        return $keepAway->getMonkeyBusiness();
    }

}