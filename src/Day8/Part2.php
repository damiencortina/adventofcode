<?php

declare(strict_types=1);

namespace Day8;

class Part2
{

    public function solve($inputFile): int
    {
        $bestTreeScore = 0;
        $lines = array_map(fn(string $line): array => str_split($line), file($inputFile, FILE_IGNORE_NEW_LINES));
        $height = count($lines);
        $width = count($lines[0]);
        foreach ($lines as $lineIndex => $trees){
            foreach ($trees as $columnIndex => $tree){
                $leftView = $this->getSideScore(
                    array_reverse(array_slice($trees, 0, $columnIndex)), $tree);
                $rightView = $this->getSideScore(
                    array_slice($trees, $columnIndex + 1, $width), $tree);
                $topView = $this->getSideScore(
                    array_reverse(array_slice(array_column($lines, $columnIndex), 0, $lineIndex)), $tree);
                $bottomView = $this->getSideScore(
                    array_slice(array_column($lines, $columnIndex), $lineIndex + 1, $height), $tree);
                $treeScore = $leftView * $rightView * $topView * $bottomView;
                if($treeScore > $bestTreeScore) $bestTreeScore = $treeScore;
            }
        }
        return $bestTreeScore;
    }

    private function getSideScore($sideTrees, $tree): int
    {
        $sideView = 0;
        foreach ($sideTrees as $sideTree){
            $sideView++;
            if($sideTree >= $tree) break;
        }
        return $sideView;
    }
}