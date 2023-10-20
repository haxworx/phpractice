<?php

function countFiles(int &$count, $directory)
{
    $directories = [];
    $dh = @opendir($directory);
    if (!$dh) return;

    while (($file = readdir($dh)) !== false) {
        if ($file === '.' || $file === '..') continue;
        $path = sprintf("%s/%s", $directory, $file);
        $count++;
        if (is_link($path)) continue;
        if (is_dir($path)) {
            $directories[] = $path;
        }
    }

    closedir($dh);

    foreach ($directories as $path) {
        countFiles($count, $path);
    }
}

function usage(): void
{
    printf("%s <directory>\n", $_SERVER['argv'][0]);
    exit(1);
}

function main(array $args): int
{
    if (count($args) !== 2) {
        usage();
    }
    
    $count = 0;

    countFiles($count, $args[1]);
    
    printf("Found %d files.\n", $count);
    
    return 0;
}

exit(main($argv));
