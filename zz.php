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

    private function reset(): void
    {
        $this->fseek(0);
    }

    public function getContents(): string
    {
        $this->reset();
        return $this->fread($this->getSize());
    }

    public function sha256(): string
    {
        return hash('sha256', $this->getContents());
    }

    public function sha512(): string
    {
        return hash('sha512', $this->getContents());
    }
}

function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <file>\n", $_SERVER['argv'][0]);
        return 1;
    }
    
    try {
        $f = new FileObject($args[1]);
    } catch (Exception $e) {
        printf("%s\n", $e->getMessage());
        return 1;
    }
    
    $sha256 = $f->sha256();

    printf("%s\n", $sha256);

    return 0;
}

exit(main($argv));
