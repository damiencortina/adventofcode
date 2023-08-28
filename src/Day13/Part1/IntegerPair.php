<?php

declare(strict_types=1);

namespace Day13\Part1;

class IntegerPair
{
    public function __construct(
        private readonly int $left,
        private readonly int $right
    )
    {
    }

    public function inputsAreInTheRightOrder(): bool
    {
        return $this->left < $this->right;
    }
}
