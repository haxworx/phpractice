<?php


function main(): int
{
    $it = new FileSystemIterator('/etc');
    foreach ($it as $file) {
        printf("%s\n", $file);
    }
    $it->close();
    return 0;
}

exit(main());
