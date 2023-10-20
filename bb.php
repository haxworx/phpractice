<?php

interface UserInterface
{
    public function getName(): string;
    public function getEmail(): string;
    public function getPassword(): string;
    public function setName(string $name);
    public function setPassword(string $password);
}


class User implements UserInterface
{
    public function __construct()
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }  

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
}




function main(): int
{
    $user = new User();
    return 0;
}

exit(main());
