<?php


class Filesystem
{
    private ?Closure $callback = null;

    public function __construct()
    {

    }

    private function ls(&$files, $directory)
    {
       $directories = [];

        $dh = @opendir($directory);
        if (!$dh) return; 

        while (($file = readdir($dh)) !== false) {
            if ($file === '.' || $file === '..') continue;
            $path = sprintf("%s%s%s", $directory, DIRECTORY_SEPARATOR, $file);
            if ($this->callback) ($this->callback)($path);
            $files[] = $path;
            if (is_link($path)) continue;
            if (is_dir($path)) $directories[] = $path;
        }

        closedir($dh);

        foreach ($directories as $path) {
            $this->ls($files, $path);
        }
    }

    public function setCallback(Closure $a)
    {
        $this->callback = $a;
    }

    public function fileCount(): int
    {
        $files = [];

        $this->ls($files, '/');
    
        return count($files);
    }
}

function main(): int
{
    $say = function(string $text) {
        echo "$text\n";
    };    

    $fs = new Filesystem();
    $fs->setCallback($say);
    $fileCount= $fs->fileCount();

    printf("%d\n", $fileCount);
    
    return 0;
}

exit(main());
