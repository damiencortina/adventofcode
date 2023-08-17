<?php

declare(strict_types=1);

namespace Day11\Part1;

class KeepAway
{

    private const ROUNDS = 20;
    private array $monkeys = [];

    public function __construct(string $inputFile)
    {
        foreach (explode("\n\n", file_get_contents($inputFile)) as $key => $monkeyData) {
            $monkey = new Monkey($monkeyData, $this->monkeys);
            $this->monkeys[$key] = $monkey;
            ksort($this->monkeys);
        }
    }

    public function getMonkeyBusiness(): int
    {
        foreach (range(1, self::ROUNDS) as $ignored) {
            /** @var Monkey $monkey */
            foreach ($this->monkeys as $monkey) {
                $monkey->inspectObjects();
            }
        }
        usort($this->monkeys, [$this, "compareMonkeys"]);
        return $this->monkeys[0]->inspectedObjectsCount * $this->monkeys[1]->inspectedObjectsCount;
    }

    private function compareMonkeys(Monkey $a, Monkey $b): int
    {
        return ($a->inspectedObjectsCount > $b->inspectedObjectsCount) ? -1 : 1;
    }

}