<?php

declare(strict_types=1);

namespace Day13\Part1;

class Packets
{
    private int $answer = 0;

    public function __construct(string $inputFile)
    {
        foreach (explode("\n\n", file_get_contents($inputFile)) as $key => $pair) {
            $explodedPair = explode("\n", $pair);
            foreach ($explodedPair as &$pairElement) {
                $pairElement = json_decode($pairElement);
            }
            $pair = new ListPair(...$explodedPair);
            if ($pair->inputsAreInTheRightOrder()) {
                $this->answer += $key + 1;
            }
        }
    }

    public function getAnswer(): int
    {
        return $this->answer;
    }


}