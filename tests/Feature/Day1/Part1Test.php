<?php

use Day1\Part1;

it('solves D1P1', function () {
    expect((new Part1())->solve('input/test_day_1.txt'))->toBe(24000);
});
