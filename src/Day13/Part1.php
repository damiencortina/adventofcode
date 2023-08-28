<?php

declare(strict_types=1);

namespace Day13;

use Day13\Part1\Packets;

class Part1
{

    public function solve(string $inputFile): int
    {
        $packets = new Packets($inputFile);
        return $packets->getAnswer();
    }

}