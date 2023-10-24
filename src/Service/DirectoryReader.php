<?php

namespace App\Service;

class DirectoryReader
{
    private array $files = [];

    public function __construct(
        private string $directory,
        private ?\Closure $closure = null,
    )
    {
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

    public function scan(): void
    {
        $this->reset();
        $this->ls($this->directory);
    }

    private function reset(): void
    {
        $this->files = [];
    }
}
