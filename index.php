<?php

require 'Autoloader.php';

$options = getopt('d:p:',['test']);
$day = in_array($options['d'] ?? null, range(1,25)) ? (int)$options['d'] : null;
$part = in_array($options['p'] ?? null, range(1,2)) ?(int)$options['p'] : null;
if(isset($day) && isset($part)){
    Autoloader::register();
    $puzzleClassName = "Day$day\Part$part";
    $puzzle = new $puzzleClassName;
    if(array_key_exists('test',$options)){
        $input = "input/test_day_$day.txt";
    }else{
        $input = "input/day_$day.txt";
    }
    echo $puzzle->solve($input)."\n";
}else{
    echo "Please specify a day (-d) between 1 and 25 and part (-p) 1 or 2\n";
}