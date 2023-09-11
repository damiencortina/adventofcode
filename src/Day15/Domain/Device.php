<?php

declare(strict_types=1);

namespace Day15\Domain;

abstract class Device
{

    public function __construct(
        public int $x,
        public int $y
    )
    {
    }
}