<?php

declare(strict_types=1);

namespace Day11\Part2;

class KeepAway
{

    private const ROUNDS = 10000;

    private const TEST_PREFIX = '  Test: divisible by ';

    private array $monkeys = [];

    public function __construct(string $inputFile)
    {
        $dividers = [];
        $monkeysDatas = explode("\n\n", file_get_contents($inputFile));
        foreach ($monkeysDatas as &$monkeyData) {
            $monkeyData = explode("\n", $monkeyData);
            $dividers[] = (int)str_replace(self::TEST_PREFIX, '', $monkeyData[3]);
        }
        unset($monkeyData);
        foreach ($monkeysDatas as $key => $monkeyData) {
            /** @var array $monkeyData */
            $monkey = new Monkey($monkeyData, $this->monkeys, $dividers);
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