<?php

function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <filename>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $contents = file_get_contents($args[1]);
    $words = explode("\n", $contents);
    
    printf("%d\n", count($words));


    return 0;
}

exit(main($argv));
