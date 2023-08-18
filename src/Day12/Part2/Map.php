<?php

declare(strict_types=1);

namespace Day12\Part2;

class Map
{
    public array $startingSquares;

    public function __construct(string $inputFile)
    {
        $mapRows = file($inputFile);
        foreach ($mapRows as $y => &$row) {
            $row = str_split($row);
            foreach ($row as $x => $letter) {
                $square = new Square($x, $y, $letter);
                if ($y - 1 >= 0) {
                    /** @var Square $leftSquare */
                    $leftSquare = $mapRows[$y - 1][$x];
                    $this->evaluateRelationBetween($square, $leftSquare);
                }
                if ($x - 1 >= 0) {
                    /** @var Square $topSquare */
                    $topSquare = $row[$x - 1];
                    $this->evaluateRelationBetween($square, $topSquare);
                }
                if ($square->isAStartingSquare()) $this->startingSquares[] = $square;
                $row[$x] = $square;
            }
        }
    }

    private function evaluateRelationBetween(
        Square $square1,
        Square $square2
    ): void
    {
        if ($square1->givesAccessTo($square2)) {
            $square1->addAccessibleSquare($square2);
        }
        if ($square2->givesAccessTo($square1)) {
            $square2->addAccessibleSquare($square1);
        }
    }

    public function findTheShortestPath(): ?int
    {
        $shortestPathLength = null;
        $paths = [];
        foreach ($this->startingSquares as $startingSquare) {
            $paths[] = new Path($startingSquare);
        }
        $pathIndex = 0;
        while (is_null($shortestPathLength)) {
            $path = $paths[$pathIndex ?? 0];
            /** @var Square $accessibleSquare */
            foreach ($path->currentSquare->accessibleSquares as $accessibleSquare) {
                if (!$path->passedBy($accessibleSquare) && !$accessibleSquare->alreadyVisitedBySomePath) {
                    $accessibleSquare->alreadyVisitedBySomePath = true;
                    $newPath = clone($path);
                    $newPath->addSquare($accessibleSquare);
                    $newPathLength = $newPath->getLength();
                    if ($newPath->currentSquare->isTheEndingSquare()) {
                        $shortestPathLength = $newPathLength - 1; // First square must not be counted
                        break;
                    } elseif (!empty($newPath->currentSquare->accessibleSquares)) {
                        $paths[] = $newPath;
                    }
                }
            }
            $pathIndex++;
        }
        return $shortestPathLength;
    }

}