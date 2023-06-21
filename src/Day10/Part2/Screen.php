<?php

namespace Day10\Part2;

class Screen{

    public string $output = '';

    const LINESIZE = 40;

    private Clock $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function draw(){
        if($this->lineIsComplete()){
            $this->output.="\n";
        }
        if($this->spriteIsVisible()){
            $this->output.='#';
        }else{
            $this->output.='.';
        }
    }
    
    private function lineIsComplete(): bool
    {
        return $this->getPrinterPosition() === 0;
    }

    private function getPrinterPosition(): int
    {
        return ($this->clock->cycleCount-1) % self::LINESIZE;
    }

    private function spriteIsVisible(): bool
    {
        $register = $this->clock->registerValue;
        $spriteArray = [
            $register-1,
            $register,
            $register+1
        ];
        return in_array($this->getPrinterPosition(), $spriteArray);
    }

}