<?php


function ls(array &$files, string $directory)
{
    $directories = [];
    $dh = opendir($directory);
    if (!$dh) return;

    while (($file = readdir($dh)) !== false) {
        if ($file === '.' || $file === '..') continue;
        $path = sprintf("%s/%s", $directory, $file);
        $files[] = $path;
        if (is_link($path)) continue;
        if (is_dir($path)) {
            $directories[] = $path;
        }
    }

    closedir($dh);

    foreach ($directories as $path) {
        ls($files, $path);
    }
}

function main(array $args): int
{
    $files = [];

    if (count($args) !== 2) {
        printf("%s <directory>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $directory = $args[1];

    if (!is_dir($directory)) return 1;

    ls($files, $directory);
    foreach ($files as $file) {
        printf("%s\n", $file);
    }

    return 0;
}

exit(main($argv));
