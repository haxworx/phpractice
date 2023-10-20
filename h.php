<?php

interface WriterInterface
{
    public function write(string $bytes): int;
}

interface ReaderInterface
{
    public function read(): string;
}

class Printer implements WriterInterface, ReaderInterface
{
    public function __construct(
    
    )
    {

    }

    public function read(): string
    {

    }

    public function write(string $bytes): int
    {

    }
}

function main(): int
{
    $printer = new Printer();
    return 0;
}

exit(main());
