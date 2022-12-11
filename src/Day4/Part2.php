<?php

declare(strict_types=1);

namespace Day4;

class Part2
{
    public function solve($inputFile):int{
        $sectionAssignmentOverlapping = 0;
        foreach (file($inputFile, FILE_IGNORE_NEW_LINES) as $sectionAssignment) {
            $sectionAssignmentRange = array_map(
                fn($range):array => range(...explode('-', $range)),
                explode(',',$sectionAssignment));
            if(array_intersect(...$sectionAssignmentRange)){
                $sectionAssignmentOverlapping++;
            }
        }
        return $sectionAssignmentOverlapping;
    }
}