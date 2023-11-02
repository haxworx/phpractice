<?php


class Job
{
    public function __construct(
        private string $command,
        private DateTimeImmutable $startTime = new \DateTimeImmutable("NOW"),
    )
    {
    }
    
    public function getCommand(): string
    {
        return $this->command;
    }

    public function getStartTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    public function exec(): int
    {
        exec($this->command, $errstr, $errno);

        return $errno;
    }
}

function main(array $args): int
{
    $job = new Job("ps aux");

    $ret = $job->exec();
    printf("%s\n", $ret);


    return 0;
}

exit(main($argv));
