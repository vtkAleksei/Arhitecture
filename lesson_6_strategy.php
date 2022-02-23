<?php


interface IPayMethod
{
    public function requestPayment(float $price);
    public function responsePayment($phone);
}

class QiwiStrategy implements IPayMethod
{
    public function requestPayment(float $price): bool
    {
        return true;
    }

    public function responsePayment($phone): string
    {
        return 'Send message ' . $phone;
    }
}

class WebMoneyStrategy implements IPayMethod
{
    public function requestPayment(float $price)
    {
        return true;
    }

    public function responsePayment($phone): string
    {
        return 'Send message ' . $phone;
    }
}

class YandexMoneyStrategy implements IPayMethod
{
    public function requestPayment(float $price)
    {
        return true;
    }

    public function responsePayment($phone): string
    {
        return 'Send message ' . $phone;
    }
}

class OrdersCollection
{
    protected $orders;
    protected $buyerPhone = 0000000000;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }
    public function renderOrders()
    {
    }
    public function getTotalPrice(): float
    {
        return 99.99;
    }
    public function pay(IPayMethod $method)
    {
        if ($method->requestPayment($this->getTotalPrice())) {
            return $method->responsePayment($this->buyerPhone);
        };
        return 'Оплата не прошла';
    }
}

class PayMethodsCollection
{
    public function getPaymentMethod(string $name)
    {
        if ($name === 'Qiwi') {
            return new QiwiStrategy();
        }
        if ($name === 'YandexMoney') {
            return new YandexMoneyStrategy();
        }
        if ($name === 'WebMoney') {
            return new WebMoneyStrategy();
        }
        return  new \Exception('Неизвестный метод оплаты');
    }
}



$orders = [$totalPrice, $buyerPhone];

$collection = new OrdersCollection($orders);
$paymentMethod = (new PayMethodsCollection())->getPaymentMethod('YandexMoney');
echo $collection->pay($paymentMethod);
