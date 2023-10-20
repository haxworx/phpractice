<?php

interface PlanInterface
{
    public function setPrice(int $price);
    public function getPrice(): int
    public function setFeatures(array $features);
    public function getFeatures(): array;
}

class Plan implements PlanInterface
{
    public function setPrice(int $price): static
    {
       $this->price = $price;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }
}



function main(): int
{

    return 0;
}

exit(main());
