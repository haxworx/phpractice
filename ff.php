<?php

class Job
{
    public Closure $closure;

    public function __construct(
        Closure $closure,
    )
    {
        $this->closure = $closure;
    }
}

function main(): int
{
    $a = function($i, $j) {
        return $i * $j;
    };

    $job = new Job($a);

    # Why does this work???
    $res = ($job->closure)(1, 2);

    printf("%d\n", $res);

    return 0;
}

exit(main());
