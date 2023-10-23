<?php

class FileObject extends SplFileObject
{
    public function __construct(
        string $path,
        string $mode = "r",
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
    $words = [];
    $infile = new FileObject('words.txt', 'r');
    while (!$infile->eof()) {
        $line = $infile->getLine();
        if ($line) {
            $words[] = $line;
        }
    }
    $infile = null;

    $outfile = new FileObject('words2.txt', 'w');
    foreach ($words as $i => $word) {
        $outfile->fwrite(sprintf("%d:%s\n", $i, $word));
    }

    $outfile = null;

    return 0;
}

exit(main($argv));
