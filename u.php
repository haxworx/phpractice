<?php


interface UserInterface
{
    public function getUsername(): string;
    public function getUid(): int
    public function getGid(): int
    public function getName(): string
    public function getHome(): string
    public function getShell(): string;
}


class User implements UserInterface
{
}

function main(): int
{

    return 0;
}

exit(main());
