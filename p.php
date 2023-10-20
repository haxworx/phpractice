<?php

class Question
{
    public function __construct(
        private string $text,
        private mixed $answer,
    )
    {}

    public function getText(): string
    {
        return $this->text;
    }

    public function getAnswer(): mixed
    {
        return $this->answer;
    }
}

class Quiz
{
    const QUESTION_COUNT = 12;
    private int $score = 0;

    public function __construct(
        private array $questions = [],
    )
    {

    }

    public function getRandomQuestion(): Question
    {
        return $this->questions[random_int(0, count($this->questions)-1)];
    }

    public function addQuestion(Question $question): static
    {
       $this->questions[] = $question;
    
        return $this; 
    }

    public function addScore(): void
    {
        $this->score++;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function start(): void
    {
        for ($i = 0; $i < self::QUESTION_COUNT; $i++) {
            $question = $this->getRandomQuestion();
            $guess = (int) readline($question->getText());
            if ($guess === $question->getAnswer()) {
                $this->addScore();
                printf("Correct!\n");
            } else {
                printf("Incorrect!\n");
            } 
        }

        printf("You scored %d/%d!\n", $this->getScore(), self::QUESTION_COUNT);
    }
}

function main(): int
{
    $quiz = new Quiz();
 
    for ($i = 1; $i <= 12; $i++) {
        for ($j = 1; $j <= 12; $j++) {
            $quiz->addQuestion(new Question("What is $i x $j?", (int) $i * $j));
        }
    }

    $quiz->start();

    return 0;
}

exit(main());
