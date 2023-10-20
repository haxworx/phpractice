<?php



class FileObject extends SplFileObject
{
    public function __construct(string $path)
    {
        parent::__construct($path);
    }

    public function getContents(): string
    {
        $this->fseek(0);
        return $this->fread($this->getSize());
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }
}

function main(): int
{
    $f = new FileObject('/etc/passwd');

    while (($line = $f->getLine())) {
        printf("%s\n", $line);
    }

    $f = null;
    return 0;
}

exit(main());
