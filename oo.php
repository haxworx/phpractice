<?php


class FileObject extends SplFileObject
{
    public function __construct(
        string $path, string $mode,
    )
    {
        parent::__construct($path, $mode);
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }
}

class HostsReader
{
    public function __construct()
    {
        $f = new FileObject('/etc/hosts', 'r');
        while (!$f->eof()) {
            $line = $f->getLine();
            if ($line) {
                $t = strtok($line, " \t");
                while ($t) {
                    printf("%s\n", $t);
                    $t = strtok(" \t");
                }
            }
        }
        $f = null;
    }

 
}

function main(): int
{
    $hosts = [];

    $reader = new HostsReader();

    return 0;
}

exit(main());
