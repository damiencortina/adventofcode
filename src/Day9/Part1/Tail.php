<?php

declare (strict_types=1);

namespace Day9\Part1;

class Tail extends Knot
{

    public function follow(Head $head){
        $this->x = $head->previousX;
        $this->y = $head->previousY;
    }

    public function shouldFollow(Head $head){
        return abs($head->x-$this->x)>1 || abs($head->y-$this->y)>1;
    }

    public function toArray(){
        return [$this->x, $this->y];
    }

}