<?php

class BirdFly
{
    public function fly()
    {
        echo "";
    }
}

interface Bird
{
    public function makeSound();
}

class Sparrow implements Bird
{

    public function makeSound()
    {
        echo "Sparrow sound!";
    }
}

class Penguin implements Bird
{

    public function makeSound()
    {
        echo "Penguin sound!";
    }
}

$sparrow = new Sparrow();
$sparrow->makeSound();
echo "<br>";
$penguin = new Penguin();
$penguin->makeSound();

// now we want to add fly and can't fly behavior to the birds
