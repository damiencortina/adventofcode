<?php

declare(strict_types=1);

namespace Day8;

class Part1
{

    public function solve($inputFile): int
    {
        $lines = array_map(fn(string $line): array => str_split($line), file($inputFile, FILE_IGNORE_NEW_LINES));
        $height = count($lines);
        $width = count($lines[0]);
        $visibleTrees = $width * 2 + ($height - 2) * 2;
        for ($lineIndex = 1; $lineIndex < $height - 1; $lineIndex++) {
            $trees = $lines[$lineIndex];
            for ($columnIndex = 1; $columnIndex < $width - 1; $columnIndex++) {
                $tree = $trees[$columnIndex];
                if (
                    $tree > max(array_slice($trees, 0, $columnIndex))
                    || $tree > max(array_slice($trees, $columnIndex + 1, $width))
                    || $tree > max(array_slice(array_column($lines, $columnIndex), 0, $lineIndex))
                    || $tree > max(array_slice(array_column($lines, $columnIndex), $lineIndex + 1, $height))
                ) $visibleTrees++;
            }
        }
        return $visibleTrees;
    }
}