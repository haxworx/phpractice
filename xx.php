<?php

class FileObject extends SplFileObject
{
    public function __construct(
        string $path,
        string $mode = 'r',
    )
    {
        parent::__construct($path, $mode);
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }

    public function getContents(): string
    {
        return $this->fread($this->getSize());
    }
}


function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <file>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $path = $args[1];

    $f = new FileObject($path, 'r');
    while (!$f->eof()) {
        $line = $f->getLine();
        if (!$line) continue;
        echo "$line\n";
    } 

    $f = null;

    return 0;
}

exit(main($argv));
