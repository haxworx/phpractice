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
}

function main(): int
{
    $lines = 0;
    $files = new RecursiveDirectoryIterator('/etc/');
    foreach ($files as $file) {
        if (is_dir($file) || is_link($file)) continue;
        try {
            $f = new FileObject($file);
        } catch (Exception $e) {
            echo "Ignoring: " . $e->getMessage() . "\n";
            continue;
        }
        
        while (!$f->eof()) {
            $line = $f->getLine();
            if ($line) {
                ++$lines; 
            }
        }
        $f = null;
    }

    printf("Found %d\n", $lines);

    return 0;
}

exit(main());
