<?php


class System
{
    public function __construct()
    {
    }

    public function getCpuCount(): int
    {
        $cores = 0;
        $f = fopen('/proc/stat', 'r');      
        if (!$f) return 0;

        while (($line = fgets($f)) !== false) {
            if (preg_match('/^cpu\d+/', $line))
                $cores++;
        }

        fclose($f);

        return $cores;
    }

    public
}






function main(): int
{
    $system = new System();
    $cpuCount = $system->getCpuCount();

    printf("%d\n", $cpuCount);
    return 0;

}

exit(main());
