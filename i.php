<?php


function main(): int
{
    $f = fopen('/etc/passwd', 'r');
    if (!$f) return 1;

    while (($line = fgets($f)) !== false) {
        $x = 100;
        echo gettype($line) . "\n";
    }
    printf("%d\n", $x);
    $n =fclose($f);
    print gettype($n) . " $n\n";
    return 0;
}

exit(main());
