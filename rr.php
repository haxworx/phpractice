<?php



class FileReader extends SplFileObject
{
    public function __construct(
        string $path, string $mode = 'r',
    )
    {
        parent::__construct($path, $mode);
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

    $reader = new FileReader($args[1]);
    $contents = $reader->getContents();

    var_dump($contents);


    return 0;
}

exit(main($argv));
