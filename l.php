<?php


function fibonacci(int $a, int $b)
{
    static $count = 0;

    if (++$count < 50)
    fibonacci($b, $a + $b);
    printf("%d\n", $a);
}

function main(): int
{
    fibonacci(0, 1);
    return 0;
}

main();
