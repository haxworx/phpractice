<?php

class WordCounter
{
    private int $count = 0;

    public function __construct(
        private string $fileName,
    )
    {
        $f = new SplFileObject($fileName);
        if (!$f) {
            
        }

        while (($ch = $f->fgetc())) {
            if (preg_match('/\s/', $ch)) {
                $this->count++;
            }
        }
        $f = null;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}


function main(array $args): int
{
    if (count($args) !== 2) {
        printf("%s <filename>\n", $_SERVER['argv'][0]);
        return 1;
    }

    $wordCounter = new WordCounter($args[1]);
    $count = $wordCounter->getCount();
    printf("%d\n", $count);

    return 0;
}

exit(main($argv));
