<?php

class DirectoryReader
{
    private ?Closure $closure;
    private $files = [];

    public function __construct(
        private string $directory, ?Closure $closure = null,
    )
    {
        $this->closure = $closure;
    }

    private function reset(): void
    {
        $this->files = [];
    }

    private function ls(string $directory): void
    {
        $directories = [];

        $dh = opendir($directory);
        if (!$dh) return;

        while (($file = readdir($dh)) !== false) {
            if ($file === '.' || $file === '..') continue;
            $path = sprintf("%s%s%s", $directory, DIRECTORY_SEPARATOR, $file);
            $this->files[] = $path;
            if (is_link($path)) continue;
            if (is_dir($path)) {
                $directories[] = $path;
            }
            if ($this->closure) {
                ($this->closure)($path);
            }
        }

        closedir($dh);

        foreach ($directories as $path) {
            $this->ls($path);
        }
    }

    public function getFiles(): array
    {
        $this->reset();
        $this->ls($this->directory);
        return $this->files;
    }

    public function getFileCount(): int
    {
        $this->reset();
        $this->ls($this->directory);
        return count($this->files);
    }
}


function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <directory>\n", $args[0]);
        return 1;
    }

    $reader = new DirectoryReader($args[1], function ($path) {
        printf("%s\n", $path);
    });

    $files = $reader->getFiles();

    
    $n1 = $reader->getFileCount();
    $n2 = count($files);

    printf("%d %d\n", $n1, $n2);

    return 0;
}

exit(main($argv));
