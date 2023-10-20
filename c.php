<?php


interface PlanInterface
{
    public function getFeatures(): string;
    public function getPrice(): int;
    public function getSupport(): string;
    public function setFeatures(string $features);
    public function setPrice(int $price);
    public function setSupport(string $support);
}

class Plan implements PlanInterface
{
    public function getFeatures(): string
    {
        return $this->features;
    }

    public function getPrice(): int
    {
        return  $this->price;
    }

    public function getSupport(): string
    {
        return $this->support;
    }

    public function setFeatures(string $features): static
    {
        $this->features = $features;

        return $this;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function setSupport(string $support): static
    {
        $this->support = $support;

        return $this;
    }
}

class PlanBuilder
{
    private Plan $plan;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->plan = new Plan();
    }

    public function getPlan(): Plan
    {
        $plan = $this->plan;

        $this->reset();

        return $plan;
    }

    public function setSupport(string $support):static
    {
        $this->plan->setSupport($support);
        return $this;
    }

    public function setPrice(int $price): static
    {
        $this->plan->setPrice($price);

        return $this;
    }

    public function setFeatures(string $features): static
    {
        $this->plan->setFeatures($features);

        return $this;
    }
}


function main(): int
{
    $plans = [];

    $builder = new PlanBuilder();
    $builder->setSupport('Hello World');
    $builder->setPrice(1000);
    $builder->setFeatures('A B C D E F');

    $plans[] = $builder->getPlan();

    $builder->setSupport('None')->setPrice(0)->setFeatures('A B C');

    $plans[] = $builder->getPlan();

    print_r($plans);


    return 0;
}

exit(main());
