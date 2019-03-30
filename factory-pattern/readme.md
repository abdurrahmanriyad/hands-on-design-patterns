## Factory Pattern
Define an interface for creating an object, but let subclasses decide  

## Code Example

```php
<?php

abstract class Computer
{
    public abstract function getRam();

    public abstract function getHdd();

    public abstract function getCpu();

    public function printConfiguration()
    {
        return "Ram = " . $this->getRam() . " HDD: " . $this->getHdd() . " CPU" . $this->getCpu();
    }
}

class PC extends Computer
{
    private $ram;
    private $hdd;
    private $cpu;

    public function __construct($ram, $hdd, $cpu)
    {
        $this->ram = $ram;
        $this->hdd = $hdd;
        $this->cpu = $cpu;
    }

    public function getRam()
    {
        return $this->ram;
    }

    public function getHdd()
    {
        return $this->hdd;
    }

    public function getCpu()
    {
        return $this->cpu;
    }
}

class Server extends Computer
{
    private $ram;
    private $hdd;
    private $cpu;

    public function __construct($ram, $hdd, $cpu)
    {
        $this->ram = $ram;
        $this->hdd = $hdd;
        $this->cpu = $cpu;
    }

    public function getRam()
    {
        return $this->ram;
    }

    public function getHdd()
    {
        return $this->hdd;
    }

    public function getCpu()
    {
        return $this->cpu;
    }
}

class ComputerFactory
{

    public static function getComputer($type, $ram, $hdd, $cpu)
    {
        if ($type === 'pc') {
            return new PC($ram, $hdd, $cpu);
        } else if ($type === 'server') {
            return new Server($ram, $hdd, $cpu);
        }
    }

}

$computer = ComputerFactory::getComputer('pc', '2GB', '500GB', '2.4 GHZ');
echo $computer->printConfiguration(). '<br>';

$computer = ComputerFactory::getComputer('server', '1GB', '500GB', '2.4 GHZ');
echo $computer->printConfiguration();
```