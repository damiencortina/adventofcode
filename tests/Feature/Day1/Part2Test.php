<?php

require 'src/Day1/Part2.php';

use Day1\Part2;

it('solves D1P2', function () {
    $part2 = new Part2();
    expect($part2->solve('input/test_day_1.txt'))->toBe(45000);
});
