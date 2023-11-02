<?php

$number = 0.0;

class Maths
{
    public function __construct()
    {
    }
    
    public function sum(int|float $a, int|float $b): int|float
    {
        return $a + $b;
    }

    public function pow(int $a, int $b): int
    {
        return pow($a, $b);
    }
}


$m = new Maths();

$sum = $m->sum(5, 10);
printf("%d\n", $sum);

$pow = $m->pow(2, 8);
printf("%d\n", $pow);
