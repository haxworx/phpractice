<?php


interface PlanInterface
{
    public function setPrice(int $price);
    public function getPrice(): int;
    public function setFeatures(array $features);
    public function getFeatures(): array;
}

class Plan implements PlanInterface
{
    private int $price = 0;
    private array $features = [];

    public function __construct()
    {

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

    public function setFeatures(array $features): static
    {
        $this->features = $features;

        return $this;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }
}

class PlanFactory
{
    public static function create(string $type)
    {
        return match ($type) {
            'free' => (new Plan())->setFeatures(['A'])->setPrice(0),
            'pro' => (new Plan())->setFeatures(['A', 'B', 'C'])->setPrice(1000),
        };
    }
}

function main(): int
{
    $plans = [];

    $plan = PlanFactory::create('free');

    $plans[] = $plan;

    $plan = PlanFactory::create('pro');
    
    $plans[] = $plan;

    print_r($plans);


    return 0;
}

exit(main());
