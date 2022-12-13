<?php

declare(strict_types=1);

namespace Day5;

class Part2
{

    public function solve($inputFile): string
    {
        $readCrates = true;
        $cratesPiles = [];
        foreach (file($inputFile, FILE_IGNORE_NEW_LINES) as $line) {
            if (empty($line)){
                $readCrates = false;
                continue;
            }
            if($readCrates){
                $this->readCrates($line, $cratesPiles);
            }else {
                $this->readInstructions($line, $cratesPiles);
            }
        }
        ksort($cratesPiles);
        return implode(array_map(fn($value): string => end($value), $cratesPiles));
    }

    private function readCrates($line, &$cratesPiles){
        foreach (array_chunk(str_split($line), 4) as $column => $crate) {
            $crate = trim(implode($crate), "[] ");
            if (!empty($crate) && !is_numeric($crate)){
                $cratesPiles[$column + 1] ??= [];
                array_unshift($cratesPiles[$column + 1], $crate);
            }
        }
    }

    private function readInstructions($line, &$cratesPiles){
        $instructions = explode(' ', str_replace(['move ', 'from ', 'to '], '', $line));
        array_push(
            $cratesPiles[$instructions[2]],
            ...array_splice(
                $cratesPiles[$instructions[1]],
                count($cratesPiles[$instructions[1]])-$instructions[0],
                (int)$instructions[0]));
    }

}