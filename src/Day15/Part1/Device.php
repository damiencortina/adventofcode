<?php

declare(strict_types=1);

namespace Day15\Part1;

abstract class Device
{

    public function __construct(
        public int $x,
        public int $y
    )
    {
    }
}