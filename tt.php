<?php

class FileObject extends SplFileObject
{
    public function __construct(
        string $path, string $mode = 'r',
    )
    {
        parent::__construct($path, $mode);
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }
}

function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <file>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $f = new FileObject($args[1]);
    while (!$f->eof()) {
        $line =  $f->getLine();
        if (!$line) continue;
        printf("%s\n", $line);
    }

    $f = null;

    return 0;
}

exit(main($argv));
