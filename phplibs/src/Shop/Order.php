<?php

namespace Placestart\Shop;

use Placestart\Shop\Cart;
use Valitron\Validator;

/**
 * Заказ
 */
class Order
{
    private Cart $cart;

    private bool $isValid = true;

    private array $validationErrrors = [];

    private string $delivery = "";

    private string $time = "";

    private string $payment = "";

    public string $fio = "";

    public string $email = "";

    public string $phone = "";

    public string $city = "";

    public string $street = "";

    public string $house_number = "";

    public int $entrance = -1;

    public int $floor = -1;

    public int $office = -1;

    public int $change = -1;

    public int $person_number = -1;

    public string $comment = "";

    public bool $cutlery = false;

    function __construct(string $cartID = DEFAULT_CART_ID)
    {
        $this->cart = new Cart($cartID);
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function validationErrors(): array
    {
        return $this->validationErrrors;
    }

    public function courierDelivery()
    {
        $this->delivery = 'courier';
    }

    public function pickupDelivery()
    {
        $this->delivery = 'pickup';
    }

    public function cashPayment()
    {
        $this->payment = 'cash';
    }

    public function cardPayment()
    {
        $this->payment = 'card';
    }

    public function asapTime(){
        $this->time = 'asap';
    }

    public function certainTime(){
        $this->time = "certain_time";
    }

    public function getDelivery(): string
    {
        return $this->delivery;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getPayment(): string
    {
        return $this->payment;
    }

    public function validate(): bool
    {
        $fields = [
            'delivery' => $this->delivery,
            "fio" => $this->fio,
            "email" => $this->email,
            "phone" => $this->phone,
            "city" => $this->city,
            "street" => $this->street,
            "house_number" => $this->house_number,
            "entrance" => $this->entrance,
            "floor" => $this->floor,
            "office" => $this->office,
            "time" => $this->time,
            "payment" => $this->payment,
            "change" => $this->change,
            "person_number" => $this->person_number,
            "comment" => $this->comment
        ];

        $v = new Validator($fields);
        $v->setPrependLabels(false);
        $v->rule('required', [
            'delivery',
            'fio',
            'email',
            'phone',
            'time',
            'payment'
        ]);
        $v->rule('in', 'delivery', ['courier', 'pickup']);
        $v->rule('in', 'payment', ['cash', 'card']);
        $v->rule('in', 'time', ['asap', 'certain_time']);
        $v->rule('integer', ['change', 'person_number']);
        $v->rule('email', 'email');

        if ($this->delivery == 'courier'){
            $v->rule('required', [
                'city',
                'street',
                'house_number',
                'entrance',
                'floor',
                'office',
            ]);
            $v->rule('integer', ['entrance', 'floor', 'office']);
            $v->rule('min', ['entrance', 'floor', 'office'], 1);
        }

        $is_valid = $v->validate();

        if (!$is_valid) {
            $this->isValid = false;
            $this->validationErrrors = $v->errors();
        } else {
            $this->isValid = true;
            $this->validationErrors = [];
        }

        return $is_valid;
    }

    /**
     * Создает объект заказа из массива полей. Удобно для создания заказа в ajax запросах из $_REQUEST
    */
    public static function createFromFields(array $fields, string $cartID = DEFAULT_CART_ID)
    {
        $order = new Order($cartID);

        switch ($fields['delivery']) {
            case 'courier':
                $order->courierDelivery();
                break;
            case 'pickup':
                $order->pickupDelivery();
                break;
        }

        switch ($fields['payment']) {
            case 'cash':
                $order->cashPayment();
                break;
            case 'card':
                $order->cardPayment();
                break;
        }

        switch ($fields['time']) {
            case 'asap':
                $order->asapTime();
                break;
            case 'certain_time':
                $order->certainTime();
                break;
        }

        $order->fio = $fields['fio'];
        $order->email = $fields['email'];
        $order->phone = $fields['phone'];
        $order->city = $fields['city'];
        $order->street = $fields['street'];
        $order->house_number = $fields['house_number'];
        $order->entrance = (int) $fields['entrance'];
        $order->floor = (int) $fields['floor'];
        $order->office = (int) $fields['office'];
        $order->change = (int) $fields['change'];
        $order->person_number = (int) $fields['person_number'];
        $order->comment = $fields['comment'];
        $order->cutlery = $fields['cutlery'] ?? false;

        return $order;
    }
}