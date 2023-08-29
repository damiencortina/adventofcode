<?php

declare(strict_types=1);

namespace Day13;

use Day13\Part2\Packets;

class Part2
{

    public function solve(string $inputFile): int
    {
        $packets = new Packets($inputFile);
        return $packets->getAnswer();
    }

}