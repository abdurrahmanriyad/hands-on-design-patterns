<?php

interface Chain
{
public function setNext(Chain $nextInChain);
public function process(Number $request);
}

class Number {
    private $number;

    /**
     * Number constructor.
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }
}

class NegativeProcessor implements Chain {
    private $nextInChain;

    public function setNext(Chain $nextInChain)
    {
        $this->nextInChain = $nextInChain;
    }

    public function process(Number $request)
    {
        if ($this->isNegative($request->getNumber())) {
            echo "Number " . $request->getNumber() . " is negative" . "</br>";
        } else {
            $this->nextInChain->process($request);
        }

    }

    public function isNegative($num)
    {
        return $num < 0;
    }
}

class ZeroProcessor implements Chain {
    private $nextInChain;

    public function setNext(Chain $nextInChain)
    {
        $this->nextInChain = $nextInChain;
    }

    public function process(Number $request)
    {
        if ($this->isZero($request->getNumber())) {
            echo "Number " . $request->getNumber() . " is Zero" . "</br>";
        } else {
            $this->nextInChain->process($request);
        }

    }

    public function isZero($num)
    {
        return 0 === $num;
    }
}


class PositiveProcessor implements Chain {
    private $nextInChain;

    public function setNext(Chain $nextInChain)
    {
        $this->nextInChain = $nextInChain;
    }

    public function process(Number $request)
    {
        if ($this->isPositive($request->getNumber())) {
            echo "Number " . $request->getNumber() . " is Positive" . "</br>";
        } else {
            $this->nextInChain->process($request);
        }

    }

    public function isPositive($num)
    {
        return 0 < $num;
    }
}

$c1 = new NegativeProcessor();
$c2 = new ZeroProcessor();
$c3 = new PositiveProcessor();
$c1->setNext($c2);
$c2->setNext($c3);

//calling chain of responsibility
$c1->process(new Number(90));
$c1->process(new Number(-50));
$c1->process(new Number(0));
$c1->process(new Number(91));