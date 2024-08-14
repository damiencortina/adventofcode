<?php

use Day2\Part1;

it('solves D2P1', function () {
    expect((new Part1())->solve('input/test_day_2.txt'))->toBe(15);
});
