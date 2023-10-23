<?php

class FileObject extends SplFileObject
{
    public function __construct(string $path)
    {
        parent::__construct($path);
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }
}

interface UserInterface
{
    public function getUsername(): string;
    public function getShell(): string;
}

class User implements UserInterface
{
    public function __construct(
        private string $username,
        private string $shell,
    )
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getShell(): string
    {
        return $this->shell;
    }
}

class UserReader
{
    private array $users = [];

    public function __construct(
    )
    {
        $f = new FileObject('/etc/passwd');
        while (!$f->eof()) {
            $line = $f->getLine();
            if (preg_match('/^([A-Za-z0-9_-]+):\w:\d+:\d+:.*?:.*?:(.*?)$/', $line, $matches)) {
                $user = new User($matches[1], $matches[2]);
                $this->users[] = $user;
            }

        }

        $f = null;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}

function main(array $args): int
{
    $reader = new UserReader();

    $users = $reader->getUsers();
    foreach ($users as $user) {
        printf("%s %s\n", $user->getUsername(), $user->getShell());
    }

    return 0;
}

exit(main($argv));
