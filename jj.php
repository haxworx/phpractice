<?php

class Sentence
{
    public function __construct(
        private string $text, private int $wordCount = 5
    )
    {

    }

    public function getText(): string
    {
        return $this->text;
    }
}


class SentenceBuilder
{
    private Sentence $sentence;

    public function __construct() {}

    public function setWordCount(int $count): static
    {
        $this->wordCount = $count;
    }

    public function build(): Sentence
    {
        $sentence = $this->sentence;
        $this->sentence = new Sentence();
    }
}

function main(): int
{
    $builder = new SentenceBuilder();
    $builder->setWordCount(10);
    $sentence = $builder->getSentence();

    


    return 0;
}

exit(main());
