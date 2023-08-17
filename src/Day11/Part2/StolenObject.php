<?php

declare(strict_types=1);

namespace Day11\Part2;

class StolenObject
{

    public int $value;

    public array $dividers = [];

    public function __construct(
        $value,
        $dividers
    )
    {
        $this->value = $value;
        foreach ($dividers as $divider) {
            $this->dividers[$divider] = $value % $divider;
        }
    }

    public function riseStressLevel(string $operator, string $operand): void
    {
        $operand = ($operand === 'old' ? null : intval($operand));
        if ($operator === '+') {
            foreach ($this->dividers as $divider => &$remain) {
                $remain += $operand ?? $remain;
                $remain %= $divider;
            }
        } else {
            foreach ($this->dividers as $divider => &$remain) {
                $remain *= $operand ?? $remain;
                $remain %= $divider;
            }
        }
    }

}