<?php

class Car
{
    public int $wheels;
    public string $color;

    public function __construct(
    
    )
    {

    }
}

class CarBuilder
{
    private $item;

    public function __construct() {
        $this->reset();
    }

    public function reset()
    {
        $this->item = new Car();
    }

    public function setWheels(int $n): static
    {
        $this->item->wheels = $n;

        return $this;
    }

    public function setColor(string $color): static
    {
        $this->item->color = $color;

        return $this;
    }

    public function getCar(): Car
    {
        $car = $this->item;
        $this->reset();
        return $car;
    }
}


function main(): int
{
    $builder = new CarBuilder();
    $builder->setWheels(4);
    $builder->setColor('red');
    $car = $builder->getCar();

    $builder->setWheels(2);
    $builder->setColor('green');
    $car2 = $builder->getCar();
    
    var_dump($car2);
    var_dump($car);

    return 0;
}

exit(main());
