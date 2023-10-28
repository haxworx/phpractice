<?php




class DirectoryReader
{
    private $files = [];

    public function __construct(
        private string $directory,
        private ?\Closure $closure = null,
    )
    {

    }

    public function reset(): void
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

    public function getFiles()
    {
        $this->reset();
        $this->ls($this->directory);
        return $this->files;
    }

    public function countFiles(): int
    {
        if (!$this->files) {
            $this->ls($this->directory);
        }
        return count($this->files);
    }
}

function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <directory>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $reader = new DirectoryReader($args[1], function ($path) {
        printf("%s\n", $path);
    });

    $files = $reader->getFiles();
    foreach ($files as $path) {
        printf("%s\n", $path);
    }

    $n = $reader->countFiles();
    printf("%d filez\n", $n);

    return 0;
}

exit(main($argv));
