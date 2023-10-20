<?php

interface UserInterface
{
    public function setName(string $name);
    public function setUid(int $uid);
    public function setPassword(string $password);
    public function setShell(string $shell);

    public function setHome(string $home);

    public function getName(): string;
    public function getUid(): int;
    public function getPassword(): string;

    public function getShell(): string;

    public function getHome(): string;
}
class User implements UserInterface
{
    private string $username;
    private string $name;
    private string $home;
    private string $shell;
    private int $uid;
    private int $gid;
    public function __construct()
    {

    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUid(): int
    {
        return $this->uid;
    }

    public function getGid(): int
    {
        return $this->gid;
    }

    public function getHome(): string
    {
        return $this->home;
    }

    public function setHome(string $home): static
    {
        $this->home = $home;

        return $this;
    }
    public function getShell(): string
    {
        return $this->shell;
    }

    public function setShell(string $shell):static
    {
        $this->shell = $shell;

        return $this;
    }

    public function setUid(int $uid): static
    {
        $this->uid = $uid;

        return $this;
    }

    public function setGid(int $gid): static
    {
        $this->gid = $gid;

        return $this;
    }
}

class UserBuilder
{
    private User $user;
    public function __construct()
    {
        $this->reset();
    }

    private function reset()
    {
        $this->user = new User();
    }

    public function getUser(): User
    {
        $user = $this->user;
        $this->reset();
        return $user;
    }
}

function main(): int
{
    $builder = new UserBuilder();
    $builder->user->setHome('/home/alastair');
    $builder->user->setPassword('letmein');

    $user = $builder->getUser();

    print_r($user);

    return 0;
}

exit(main());
