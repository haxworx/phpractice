<?php


interface Automobile
{
    public function setWheels(int $n);
    public function setColor(string $color);
    public function setType(string $type);
}

abstract class Car implements Automobile
{
    public function setWheels(int $n)
    {
        $this->wheels = $n;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }
}

class Audi extends Car
{
    public function __construct()
    {
        $this->setWheels(4);
        $this->setColor('Red');
        $this->setType('Audi');
    }
}

class CarFactory
{
    public static function create(
        string $type,
    )
    {
        return match ($type) {
            'Audi' => new Audi()
        }; 
    }
}



function main(): int
{

    $car = CarFactory::create('Audi');
    var_dump($car);

    return 0;
}

exit(main());
