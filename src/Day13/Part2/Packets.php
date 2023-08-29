<?php

declare(strict_types=1);

namespace Day13\Part2;

class Packets
{
    private const DIVIDER_PACKETS = [[[2]], [[6]]];
    private int $answer = 1;

    public function __construct(string $inputFile)
    {
        $packets = str_replace("\n\n", "\n", file_get_contents($inputFile));
        $packets = explode("\n", $packets);
        foreach ($packets as &$packet) {
            $packet = json_decode($packet);
        }
        array_push($packets, ...self::DIVIDER_PACKETS);
        usort($packets, [$this, 'sort']);
        foreach (self::DIVIDER_PACKETS as $dividerPacket) {
            $this->answer *= (array_search($dividerPacket, $packets) + 1);
        }
    }

    private function sort(array $leftPacket, array $rightPacket): ?bool
    {
        $pair = new ListPair($leftPacket, $rightPacket);
        return !$pair->inputsAreInTheRightOrder();
    }

    public function getAnswer(): int
    {
        return $this->answer;
    }


}