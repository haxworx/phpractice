<?php

class ServiceReader
{
    private array $services = [];

    public function __construct()
    {
        $f = new SplFileObject('/etc/services');
        while (!$f->eof()) {
            $line = $f->fgets();
            if (!$line) continue;
            if (preg_match('/^([A-Za-z0-9_-]+)\s+(\d+)\/tcp.*?/', $line, $matches)) {
                $this->services[intval($matches[2])] = $matches[1];
            }
        }     
        $f = null;
    }

    public function getServices(): array
    {
        return $this->services;
    }
}




function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <host>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $serviceReader = new ServiceReader();
    $services = $serviceReader->getServices();

    foreach ($services as $port => $service) {
        $sock = @fsockopen($args[1], $port, $errtr, $errno);
        if ($sock) {
            printf("Connected on %d (%s)\n", $port, $service); 
            fclose($sock);
        }
    }

    return 0;
}

exit(main($argv));
