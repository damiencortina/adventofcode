<?php

declare (strict_types=1);

namespace Day9\Part2;

class Knot
{

    protected Knot $previousKnot;

    protected Knot $nextKnot;

    protected int $x = 0;

    protected int $y = 0;

    public function follow(){
        if(abs($this->previousKnot->x-$this->x)>1 || abs($this->previousKnot->y-$this->y)>1 ){
            $this->previousKnot->x > $this->x ? $this->x++ : $this->previousKnot->x != $this->x && $this->x--;
            $this->previousKnot->y > $this->y ? $this->y++ : $this->previousKnot->y != $this->y && $this->y--;
        }
        isset($this->nextKnot) && $this->nextKnot->follow();
    }

    public function setPreviousKnot(Knot $knot): self{
        $this->previousKnot = $knot;
        $knot->nextKnot = $this;
        return $this;
    }

}