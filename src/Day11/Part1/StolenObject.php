<?php

declare(strict_types=1);

namespace Day11\Part1;

class StolenObject
{

    public int $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function applyRelief(): void
    {
        $this->value = (int)floor($this->value / 3);
    }

    public function riseStressLevel(string $operator, string $operand): void
    {
        $operand = ($operand === 'old' ? $this->value : intval($operand));
        if ($operator === '+') {
            $this->value += $operand;
        } else {
            $this->value *= $operand;
        }
    }

}