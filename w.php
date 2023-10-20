<?php



function main(): int
{
    $f = new SplFileObject('/etc/passwd');

    $bytes = 0;
        
    while (!$f->eof()) {
        $ch = $f->fgetc();
        if ($ch !== false)
            ++$bytes;
        echo "$ch\n";
    }

    printf("%d\n", $bytes);


    return 0;
}

exit(main());
