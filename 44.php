<?php

class Question
{
    public function __construct(
        private string $text,
        private mixed $answer,
    )
    {
    }
    
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
    const MAX_QUESTIONS = 12;
    private int $score = 0;

    public function __construct(
        private array $questions = [],
    )
    {
    }

    public function addQuestion(Question $question): static
    {
        $this->questions[] = $question;
    
        return $this;
    }

    public function play(): void
    {
        for ($i = 0; $i < self::MAX_QUESTIONS; $i++) {
            $question = $this->questions[random_int(0, count($this->questions) -1)];
            $guess = (int) readline($question->getText());
            if ($guess !== $question->getAnswer()) {
                printf("Incorrect!\n");
            } else {
                $this->score++;
                printf("Correct!\n");
            }
        }
        printf("You scored %d/%d\n", $this->score, self::MAX_QUESTIONS);
    }
}


function main(array $args): int
{
    $quiz = new Quiz();

    for ($i = 1; $i <= 12; $i++) {
        for ($j = 1; $j <= 12; $j++) {
            $quiz->addQuestion(new Question("What is $i x $j? ", (int) $i * $j));
        }
    }

    $quiz->play();

    return 0;
}

exit(main($argv));
