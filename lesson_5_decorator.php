<?php

interface Message
{
    public function sendMessage(): string;
}

class smsMessage implements Message
{
    public function sendMessage(): string
    {

        return "ConcreteComponent";
    }
}

class Decorator implements Message
{
    /**
     * @var Component
     */
    protected $component;

    public function __construct(Message $component)
    {

        $this->component = $component;
    }

    public function sendMessage(): string
    {

        return $this->component->sendMessage();
    }
}

class emailDecorator extends Decorator
{
    public function sendMessage(): string
    {

        return "emailDecorator(" . parent::sendMessage() . ")";
    }
}

class cnDecorator extends Decorator
{
    public function sendMessage(): string
    {

        return "cnDecorator(" . parent::sendMessage() . ")";
    }
}

function clientCode(Message $component)
{

    // ...

    echo "RESULT: " . $component->sendMessage();

    // ...
}



$decorator1 = new smsMessage();
clientCode($decorator1);

$decorator2 = new smsMessage(new emailDecorator($message));
clientCode($decorator2);

$decorator3 = new smsMessage(new cnDecorator($message));
clientCode($decorator3);

$decorator4 = new smsMessage(new cnDecorator(new emailDecorator($message)));
clientCode($decorator4);
