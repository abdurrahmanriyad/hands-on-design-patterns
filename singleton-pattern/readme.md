## Singleton Pattern
Singleton pattern is a software design pattern that restricts the instantiation of a class to one "single" instance.  

## Code Example

```php
<?php
class Singleton {
    public $name = "Riyad";
    private static $instance = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new Singleton();
        }

        return self::$instance;
    }
}

$singleton = Singleton::getInstance();
$singleton->name = 'Abdur Rahman';


$singleton2 = Singleton::getInstance();
echo $singleton2->name;
```