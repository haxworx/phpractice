<?php

class MyIterator implements Iterator
{
    private int $position = 0;
    private array $array = [
        'Alastair',
        'Edward',
        'Gail',
    ];
    
    public function __construct()
    {
        $this->position = 0;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): string
    {
        return $this->array[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->array[$this->position]);
    }
}

function main(): int
{
    $it = new MyIterator();

    foreach ($it as $k => $v) {
        printf("%d => %s\n", $k, $v);
    }


    return 0;
}

exit(main());
