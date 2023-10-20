<?php

$squares = [];

function isSquare(int $n): bool
{
    global $squares;

    return in_array($n, $squares);
}


function main(): int
{
    global $squares;
    
    for ($i = 1; $i <= 100; $i++) {
        $squares[] =  $i * $i;
    }
    for ($i = 1; $i < 1000; $i++) {
        $ok = isSquare($i);
        if ($ok) {
            printf("%d is square!\n", $i);
        }
    }

    return 0;
}

exit(main());
