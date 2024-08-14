<?php

use Day1\Part2;

it('solves D1P2', function () {
    expect((new Part2())->solve('input/test_day_1.txt'))->toBe(45000);
});
