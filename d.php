<?php

interface PlanInterface
{
    public function setFeatures(array $features);
    public function getFeatures(): array;
    public function setPrice(int $price);
    public function getPrice(): int;
}


class Plan implements PlanInterface
{
    private array $features = [];
    private int $price = 0;

    public function __construct()
    {
    }

    public function setFeatures(array $features): static
    {
        $this->features = $features;

        return $this;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}


class PlanBuilder
{
    private $plan;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->plan = new Plan();
    }

    public function setFeatures(array $features): static
    {
        $this->plan->setFeatures($features);
        return $this;
    }

    public function setPrice(int $price): static
    {
        $this->plan->setPrice($price);

        return $this;
    }

    public function getPlan(): Plan
    {
        $plan = $this->plan;
        $this->reset();
        return $plan;
    }
}

function main(): int
{
    $plans = [];

    $builder = new PlanBuilder();
    $builder->setPrice(1000);
    $builder->setFeatures(['A', 'B', 'C']);
    $plans[] = $builder->getPlan();

    $builder->setPrice(0);
    $builder->setFeatures(['A']);
    $plans[] = $builder->getPlan();

    print_r($plans);


    return 0;
}

exit(main());
