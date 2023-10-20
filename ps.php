<?php

class FileObject extends SplFileObject
{
    public function __construct(
        string $fileName,
    )
    {
        parent::__construct($fileName);
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }
}

class Service
{
    public function __construct(
        private int $port,
        private string $name,
    )
    {
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class ServiceReader
{
    private array $services = [];

    public function __construct()
    {
        $f = new FileObject('/etc/services');
        while (!$f->eof()) {
            $line = $f->getLine();
            if (preg_match('/^(\w+)\s+(\d+)\/tcp/', $line, $matches)) {
                $this->services[] = new Service(intval($matches[2]), $matches[1]);
            }
        }
        $f = null;
    }

    public function get(): array
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
    $services = $serviceReader->get();
    foreach ($services as $service) {
        $sock = @fsockopen($args[1], $service->getPort(), $errstr, $errno, 5);
        if ($sock) {
            printf("Connected on %d (%s)\n", $service->getPort(), $service->getName());
            fclose($sock);
        }
    }

    return 0;
}

exit(main($argv));
