<?php
    /**
     * @var string $status
     * @var Placestart\Shop\Order $order
    */

    $order = $args["order"];
    $cart = $order->getCart();
?>

<h1>Новый заказ</h1>

<h3>Состав заказа</h3>
<?php foreach ($cart->getCartItems() as $cart_item): ?>
    <p>
        <?= $cart_item->getProduct()->getTitle() ?>
        <b><?= $cart_item->getCount() ?> шт.</b>
    </p>
<?php endforeach ?>

<hr>

<p>
    <b>Способ оплаты:</b>
    <?= $order->getPayment() == "cash" ? "Наличными при получении" : "Картой при получении" ?>
</p>
<p>
    <b>Время доставки:</b>
    <?= $order->getTime() == "asap" ? "Как можно быстрее" : "К определенному времени" ?>
</p>
<p>
    <b>Способ получения заказа:</b>
    <?= $order->getDelivery() == "courier" ? "Курьером" : "Самовывоз" ?>
</p>

<hr>

<h3>Контактные данные</h3>
<p><b>Имя:</b> <?= $order->fio ?></p>
<p><b>Email:</b> <?= $order->email ?></p>
<p><b>Телефон:</b> <?= $order->phone ?></p>

<h3>Адрес доставки</h3>
<p><b>Город:</b> <?= $order->city ?></p>
<p><b>Улица:</b> <?= $order->street ?></p>
<p><b>Номер дома:</b> <?= $order->house_number ?></p>
<p><b>Подъезд:</b> <?= $order->entrance ?></p>
<p><b>Этаж:</b> <?= $order->floor ?></p>
<p><b>Квартира/офис:</b> <?= $order->office ?></p>

<h3>Дополнительная информация</h3>
<?php if ($order->change > 0): ?>
    <p><b>Требуется сдача с:</b> <?= $order->change ?></p>
<?php endif ?>
<?php if ($order->person_number > 0): ?>
    <p><b>Количество персон:</b> <?= $order->person_number ?></p>
<?php endif ?>
<p><b>Нужны приборы:</b> <?= $order->cutlery ? "да" : "нет" ?></p>
<?php if ($order->comment): ?>
    <p><b>Дополнительные комментарии к заказу (удобное время, ориентиры для курьера, пожелания и т.д.):</b> <?= $order->comment ?></p>
<?php endif ?>