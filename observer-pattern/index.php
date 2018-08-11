<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

interface Subject
{
    public function registerObserver(Observer $observer);

    public function removeObserver(Observer $observer);

    public function notifyObservers();
}

interface Observer
{
    public function update($temp, $humidity, $pressure);
}

interface DisplayElement
{
    public function display();
}

class WeatherData implements Subject
{
    private $observers;
    private $temperature;
    private $humidity;
    private $pressure;

    public function __construct()
    {
        $this->observers = array();
    }

    public function registerObserver(Observer $observer)
    {
        array_push($this->observers, $observer);
    }

    public function removeObserver(Observer $observer)
    {
        $foundObserver = array_search($observer, $this->observers);

        if ($foundObserver) {
            unset($this->observers[$foundObserver]);
        }
    }

    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    public function measurementsChanged()
    {
        $this->notifyObservers();
    }

    public function serMeasurements($temperature, $humidity, $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;

        $this->measurementsChanged();
    }
}

class CurrentConditionsDisplay implements Observer, DisplayElement
{
    private $temperature;
    private $humidity;
    private $pressure;
    private $weatherData;

    public function __construct(Subject $weatherData)
    {
        $this->weatherData = $weatherData;
        $weatherData->registerObserver($this);
    }

    public function update($temp, $humidity, $pressure)
    {
        $this->temperature = $temp;
        $this->humidity = $humidity;
        $this->pressure = $pressure;

        $this->display();
    }

    public function display()
    {
        echo "Current Condition: " . $this->temperature . "F degree and " . $this->humidity . "% humidity <br>";
    }
}


$weatherData = new WeatherData();

$currentConditionsDisplay = new CurrentConditionsDisplay($weatherData);

$weatherData->serMeasurements(80, 65, 30.4);
$weatherData->serMeasurements(12, 15, 80.4);
$weatherData->serMeasurements(83, 75, 55.4);
