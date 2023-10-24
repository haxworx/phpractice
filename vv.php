<?php

function main(): int
{
    exec("ls", $output, $res);
    var_dump($res);

    exec("ps", $output, $res);
    printf("$res\n");

    return 0;
}

exit(main());
