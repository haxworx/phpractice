<?php

class DirectoryReader
{
    private array $files = [];

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
        $directories = [];

        $dh = opendir($directory);
        if (!$dh) return;

        while (($file = readdir($dh)) !== false) {
            if ($file === '.' || $file === '..') continue;
            $path = sprintf("%s%s%s", $directory, DIRECTORY_SEPARATOR, $file);
            $this->files[] = $path;
            if ($this->closure) {
                ($this->closure)($path);
            }
            if (is_link($path)) continue;
            if (is_dir($path)) {
                $directories[] = $path;
            }
        }

        closedir($dh);

        foreach ($directories as $path) {
            $this->ls($path);
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
    $reader = new DirectoryReader($args[1], function ($path) {
        printf("%s\n", $path);
    });

    $reader->scan();

    $reader = new DirectoryReader($args[1]);
    $files = $reader->getFiles();
    foreach ($files as $file) {
        printf("%s\n", $file);
    }

    return 0;
}

exit(main($argv));
