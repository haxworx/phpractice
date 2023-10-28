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

class DirectoryReader
{
    private $files = [];

    public function __construct(
        private string $directory,
        private ?Closure $closure = null,
    )
    {
 
    }

    private function reset(): void
    {
        $this->files = [];
    }

    private function ls(string $directory): void
    {
        $dirs = [];
        $dh = opendir($directory);
        if (!$dh) return;

        while (($file = readdir($dh)) !== false) {
            if ($file === '.' || $file === '..') continue;
            $path = sprintf("%s%s%s", $directory, DIRECTORY_SEPARATOR, $file);
            if ($this->closure) {
                ($this->closure)($path);
            }
            if (is_link($path)) continue;
            if (is_dir($path)) {
                $dirs[] = $path;
            } else {
                $this->files[] = $path;
            }
        }

        closedir($dh);

        foreach ($dirs as $dir) {
            $this->ls($dir);
        }
    }

    public function scan(): void
    {
        $this->reset();
        $this->ls($this->directory);
    }

    public function getFiles(): array
    {
        $this->reset();
        $this->ls($this->directory);
        return $this->files;
    }
}


function main(array $args): int
{
    $lineCount = 0;
    if (count($args) !== 2) {
        printf("%s <directory>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $reader = new DirectoryReader($args[1]);
    $files = $reader->getFiles();
    foreach ($files as $file) {
        $f = new FileObject($file);
        while (!$f->eof()) {
            $line = $f->getLine();
            ++$lineCount;
        }
        $f = null; 
    }
    printf("%d lines, Jesus Christ!\n", $lineCount);

    return 0;
}

exit(main($argv));
