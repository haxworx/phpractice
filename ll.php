<?php

enum ExitStatus
{
    case SUCCESS;
    case FAILURE;
}

function main(): int
{
    $a = ExitStatus::SUCCESS;
    var_dump($a);

    return 0;
}

exit(main());
