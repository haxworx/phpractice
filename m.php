<?php


class User
{
    public function __construct(
        private string $name,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class UserReader
{
    private array $users = [];

    public function __construct(
    )
    {
        $f = new SplFileObject('/etc/passwd');
        while (($line = $f->fgets())) {
            if (preg_match('/^([A-Za-z0-9_]+):.*?/', $line, $matches)) {
               $this->users[] = new User($matches[1]);
            }
        }
        $f = null;
        sort($this->users);
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}

function main(): int
{
    $userReader = new UserReader();
    $users = $userReader->getUsers();

    foreach ($users as $user) {
        printf("%s\n", $user->getName());
    }


    return 0;
}

exit(main());
