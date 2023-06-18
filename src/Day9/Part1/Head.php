<?php

declare (strict_types=1);

namespace Day9\Part1;

class Head extends Knot
{

    private const MOVEMENTS = [
        'R'=>[ // Move to the Right
            'x'=>1,
            'y'=>0],
        'L'=>[ // Move to the Left
            'x'=>-1,
            'y'=>0],
        'U'=>[ // Move Up
            'x'=> 0,
            'y'=>1],
        'D'=>[ // Move Down
            'x'=> 0,
            'y'=>-1]];

    public int $previousX = 0;

    public int $previousY = 0;

    public function move(string $direction){
        $this->previousX = $this->x;
        $this->previousY = $this->y;
        $this->x += self::MOVEMENTS[$direction]['x'];
        $this->y += self::MOVEMENTS[$direction]['y'];
    }

}