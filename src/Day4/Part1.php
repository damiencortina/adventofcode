<?php

declare(strict_types=1);

namespace Day4;

class Part1
{
    public function solve($inputFile):int{
        $sectionAssignmentContained = 0;
        foreach (file($inputFile, FILE_IGNORE_NEW_LINES) as $sectionAssignment) {
            $sectionAssignmentRange = array_map(
                fn($section):array => range(...explode('-', $section)),
                explode(',',$sectionAssignment));
            $sectionsAssignmentRangeIntersection = array_values(array_intersect(...$sectionAssignmentRange));
            if(in_array($sectionsAssignmentRangeIntersection, $sectionAssignmentRange)){
                $sectionAssignmentContained++;
            }
        }
        return $sectionAssignmentContained;
    }
}