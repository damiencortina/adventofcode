<?php

declare(strict_types=1);

namespace Day11\Part1;

class Monkey
{

    private const STARTING_ITEMS_PREFIX = '  Starting items: ';
    private const OPERATION_PREFIX = '  Operation: new = old ';
    private const TEST_PREFIX = '  Test: divisible by ';
    private const CONDITION_TRUE_PREFIX = '    If true: throw to monkey ';
    private const CONDITION_FALSE_PREFIX = '    If false: throw to monkey ';
    private array $stolenObjects;
    private int $divider;
    private ?Monkey $receiverInCaseOfSuccessfulEvaluation;
    private ?Monkey $receiverInCaseOfFailedEvaluation;
    public int $inspectedObjectsCount = 0;
    private string $operator;
    private string $operand;

    public function __construct(
        string $monkeyData,
        array  &$monkeys
    )
    {
        $instructionLines = explode("\n", $monkeyData);
        $objectsIds = $this->getObjectIdsFrom($instructionLines[1]);
        foreach ($objectsIds as $objectId) {
            $this->stolenObjects[] = new StolenObject((int)$objectId);
        }
        $operation = $this->getOperationFrom($instructionLines[2]);
        $this->operator = $operation[0];
        $this->operand = $operation[1];
        $this->divider = $this->getDividerFrom($instructionLines[3]);
        $this->receiverInCaseOfSuccessfulEvaluation =
            &$monkeys[str_replace(self::CONDITION_TRUE_PREFIX, '', $instructionLines[4])];
        $this->receiverInCaseOfFailedEvaluation =
            &$monkeys[str_replace(self::CONDITION_FALSE_PREFIX, '', $instructionLines[5])];
    }

    private function getObjectIdsFrom(string $line): array
    {
        return explode(', ', str_replace(self::STARTING_ITEMS_PREFIX, '', $line));
    }

    private function getOperationFrom(string $line): array
    {
        return explode(' ', str_replace(self::OPERATION_PREFIX, '', $line));
    }

    private function getDividerFrom(string $line): int
    {
        return (int)str_replace(self::TEST_PREFIX, '', $line);
    }

    public function inspectObjects(): void
    {
        /** @var StolenObject $object */
        foreach ($this->stolenObjects as $object) {
            $object->riseStressLevel($this->operator, $this->operand);
            $object->applyRelief();
            if ($this->inspectionIsSuccessful($object)) {
                $this->passObjectTo($this->receiverInCaseOfSuccessfulEvaluation);
            } else {
                $this->passObjectTo($this->receiverInCaseOfFailedEvaluation);
            }
            $this->inspectedObjectsCount++;
        }
    }

    private function passObjectTo(Monkey $monkey): void
    {
        $monkey->stolenObjects[] = array_shift($this->stolenObjects);
    }

    private function inspectionIsSuccessful(StolenObject $object): bool
    {
        return $object->value % $this->divider === 0;
    }

}