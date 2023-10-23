<?php


class FileObject extends SplFileObject
{
    public function __construct(
        string $path,
    )
    {
        parent::__construct($path);
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }

    public function getContents(): string
    {
        $this->fseek(0);
        return $this->fread($this->getSize());
    }
}


function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <file>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $f = new FileObject($args[1]);

    $lines = [];

    while (!$f->eof()) {
        $line = $f->getLine();
        $lines[] = $line;
    }

    $contents = $f->getContents();
    print_r($contents);


    return 0;
}

exit(main($argv));
