<?php

class Filesystem
{
    public function __construct(
        public string $device,
        public string $mount,
        public string $type,
        public string $options,
        public int $major,
        public int $minor
    )
    {

    }

}

class FilesystemReader
{
    public array $mounts = [];

    public function __construct()
    {
        $f = new SplFileObject('/etc/fstab', 'r');
        while (!$f->eof()) {
            $line = $f->fgets();
            if (preg_match('/^(.*?)\s+(.*?)\s+(.*?)\s+(.*?)\s+(\d)\s+(\d)$/', $line, $matches)) {
                $fs = new Filesystem(
                    $matches[1],
                    $matches[2],
                    $matches[3],
                    $matches[4],
                    intval($matches[5]),
                    intval($matches[6])
                );
                $this->mounts[] = $fs;
            }
        }

        $f = null;
    }

}

function main(array $args): int
{
    $reader = new FilesystemReader();
    
    $json = json_encode($reader);
    print "$json\n";

    return 0;
}

exit(main($argv));
