<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Service\DirectoryReader;

function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s\n", $_SERVER['argv'][0]);
        return 1;
    }

    $reader = new DirectoryReader($args[1], function ($path) {
        printf("%s\n", $path);
    });
    $reader->scan();

    return 0;
}

exit(main($argv));
