<?php
















function main(): int
{
    $files = (new FilesystemIterator('/etc'));
    foreach ($files as $file) {
        printf("%s\n", $file);
    }

    return 0;
}

exit(main());
