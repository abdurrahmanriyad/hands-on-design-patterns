<?php

abstract class Beverage {
    public function getDescription()
    {
        return "Unknown Description";
    }

    public abstract function cost();
}

abstract class CondimentDecorator extends Beverage {

}

class Milk extends CondimentDecorator {
    private $beverage;
    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function cost()
    {
        return 2 + $this->beverage->cost();
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . ", MilK for " . $this->cost();
    }
}

class Capuccino extends Beverage {
    public function cost()
    {
        return 20;
    }

    public function getDescription()
    {
        return "Capaccino";
    }
}

$beverage = new Capuccino();
$beverage = new Milk($beverage);

echo $beverage->getDescription();

