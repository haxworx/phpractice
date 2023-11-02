<?php

class FileObject extends SplFileObject
{
    public function __construct(
        private string $path,
        private string $mode = 'r',
    )
    {
        parent::__construct($path, $mode);
    }

    public function getContents(): string
    {
        return $this->fread($this->getSize());
    }

    public function getLine(): string
    {
        return trim($this->fgets());
    }
}

interface UserInterface
{
    public function getUsername(): string;
    public function getPassword(): string;
}

class User implements UserInterface
{
    public function __construct(
        private string $username,
        private string $password,
    )
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

function main(): int
{
    $users = [];
    $usernames = [];

    $f = new FileObject('/etc/passwd');
    while (!$f->eof()) {
        $line = $f->getLine();
        if ($line) {
            if (preg_match('/^([A-Za-z0-9_-]+):.*?/', $line, $matches)) {
                $usernames[] = $matches[1];
            }
        }
    }

    sort($usernames);    

    foreach ($usernames as $username) {
        $users[] = new User($username, bin2hex(random_bytes(12)));
    }
    
    foreach ($users as $user) {
        printf("%s %s\n", $user->getUsername(), $user->getPassword());
    }

    return 0;
}

exit(main());
