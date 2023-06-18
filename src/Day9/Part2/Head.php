<?php

declare (strict_types=1);

namespace Day9\Part2;

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

    public function move(string $direction){
        $this->x += self::MOVEMENTS[$direction]['x'];
        $this->y += self::MOVEMENTS[$direction]['y'];
        $this->nextKnot->follow();
    }

}