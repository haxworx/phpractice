<?php

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

    public function __destruct()
    {
    }
}


function main(): int
{
    $users = [];

    $f = new SplFileObject('/etc/passwd', 'r');
    while (!$f->eof()) {
        $line = $f->fgets();
        if (preg_match('/^([A-Za-z0-9-_]+):.*?/', $line, $matches)) {
            $user = new User($matches[1], bin2hex(random_bytes(32)));
            $users[] = $user;
        }
    }
    $f = null;

    foreach ($users as $user) {
        printf ("%s %s\n", $user->getUsername(), $user->getPassword());
    }

    $r = exec("ls",$lines);
    var_dump($lines);
    
    return 0;
}

exit(main());
