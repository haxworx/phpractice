<?php


interface PlanInterface
{
    public function getPlan(): array;
    public function setPlan(array $plan);
}

class Plan Implements PlanInterface
{
    private array $plan = [];

    public function getPlan(): array
    {
        return $this->plan;
    }

    public function setPlan(array $plan): static
    {
        $this->plan = $plan;

        return $this;
    } 
}

class PlanFactory
{
    public static function createPlan(): Plan
    {
        return new Plan();
    }
}

function main(): int
{

    $plan = PlanFactory::createPlan();
    $plan->setPlan(['A', 'B', 'C', 'D']);
    print_r($plan);
    return 0;
}

exit(main());
