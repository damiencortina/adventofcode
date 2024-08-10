<?php

require 'src/Day1/Part1.php';

use Day1\Part1;

it('solves D1P1', function () {
    $part1 = new Part1();
    expect($part1->solve('input/test_day_1.txt'))->toBe(24000);
});
