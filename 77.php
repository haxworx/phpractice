<?php

interface SpiritInterface
{
    public function pray(): void;
    public function move(): void;
}

class Angel implements SpiritInterface
{
    public function pray(): void
    {
        printf("Behold the breath of God!\n");
    }

    public function move(): void
    {
        printf("Moves before the throne of God\n");
    }
}

function main(array $args): int
{
    $angel = new Angel('St Michael');
    $angel->pray();
    $angel->move();

    return 0;
}

exit(main($argv));
