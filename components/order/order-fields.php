<?php
    /**
     * @var string $status
     * @var Placestart\Shop\Order $order
    */

    $status = $args["status"];
    $order = $args["order"];
    $errors = $order->validationErrors();
?>
<div x-data="{delivery: '<?= $order->getDelivery() ?>'}">
    <?php if ($status == "mail_error"): ?>
        <p>Произошла ошибка при отправке письма: <?= $args["error"] ?></p>
    <?php endif ?>
    <div class="block bottom-offset">
        <h3 class="block-title">Способ получения заказа</h3>
        <div class="choice-row">
            <label class="form-radio" @change="delivery = 'courier'">
                <input type="radio" name="delivery" value="courier" <?= $order->getDelivery() == "courier" ? "checked" : "" ?>>
                <span class="form-radio-input"></span>
                Курьером
            </label>
            <label class="form-radio" @change="delivery = 'pickup'">
                <input type="radio" name="delivery" value="pickup" <?= $order->getDelivery() == "pickup" ? "checked" : "" ?>>
                <span class="form-radio-input"></span>
                Самовывоз
            </label>
        </div>
    </div>
    <div class="block bottom-offset">
        <h3 class="block-title">Контактные данные</h3>
        <?php if( isset($errors["fio"]) || isset($errors["email"]) || isset($errors["phone"]) ): ?>
            <p class="block-error">Заполните контактные данные</p>
        <?php endif ?>
        <div class="inputs-grid">
            <div class="form-input">
                <p class="input-name">Ваше имя</p>
                <input placeholder="ФИО" name="fio" type="text" value="<?= $order->fio ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Контактный e-mail</p>
                <input placeholder="E-mail" name="email" type="email" value="<?= $order->email ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Контактный телефон</p>
                <input placeholder="+7" x-data x-mask="+7 999 999 99 99" name="phone" type="tel" value="<?= $order->phone ?>" class="input">
            </div>
        </div>
    </div>
    <div class="block bottom-offset" x-show="delivery == 'courier'">
        <h3 class="block-title">Адрес доставки</h3>
        <?php if( isset($errors["city"]) || isset($errors["street"]) || isset($errors["house_number"]) || isset($errors["entrance"]) || isset($errors["floor"]) || isset($errors["office"]) ): ?>
            <p class="block-error">Укажите адрес доставки</p>
        <?php endif ?>
        <div class="inputs-grid">
            <div class="form-input">
                <p class="input-name">Город</p>
                <input placeholder="Город" name="city" type="text" value="<?= $order->city ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Улица</p>
                <input placeholder="Улица*" name="street" type="text" value="<?= $order->street ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Номер дома</p>
                <input name="house_number" type="text" value="<?= $order->house_number ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Подъезд</p>
                <input name="entrance" type="number" value="<?= $order->entrance > 0 ? $order->entrance : "" ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Этаж</p>
                <input name="floor" type="number" value="<?= $order->floor > 0 ? $order->floor : "" ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Квартира/офис</p>
                <input name="office" type="number" value="<?= $order->office > 0 ? $order->office : "" ?>" class="input">
            </div>
        </div>
    </div>
    <div class="block bottom-offset">
        <h3 class="block-title">Время</h3>
        <div class="choice-row">
            <label class="form-radio">
                <input type="radio" name="time" value="asap" <?= $order->getTime() == "asap" ? "checked" : "" ?>>
                <span class="form-radio-input"></span>
                Как можно быстрее
            </label>
            <label class="form-radio">
                <input type="radio" name="time" value="certain_time" <?= $order->getTime() == "certain_time" ? "checked" : "" ?>>
                <span class="form-radio-input"></span>
                К определенному времени
            </label>
        </div>
        <div class="block-info content-text text-page">
            <p>* – После оформления позвонит менеджер, и вы сообщите ему нужное время </p>
        </div>
    </div>
    <div class="block bottom-offset">
        <h3 class="block-title">Способ оплаты</h3>
        <div class="choice-row">
            <label class="form-radio">
                <input type="radio" name="payment" value="cash" <?= $order->getPayment() == "cash" ? "checked" : "" ?>>
                <span class="form-radio-input"></span>
                Наличными при получении
            </label>
            <label class="form-radio">
                <input type="radio" name="payment" value="card" <?= $order->getPayment() == "card" ? "checked" : "" ?>>
                <span class="form-radio-input"></span>
                Картой при получении
            </label>
        </div>
    </div>
    <div class="block bottom-offset">
        <h3 class="block-title">Дополнительная информация</h3>
        <div class="inputs-grid dop-info">
            <div class="form-input">
                <p class="input-name">Требуется сдача с</p>
                <input name="change" type="number" value="<?= $order->change > 0 ? $order->change : "" ?>" class="input">
            </div>
            <div class="form-input">
                <p class="input-name">Количество персон</p>
                <input name="person_number" type="number" value="<?= $order->person_number > 0 ? $order->person_number : "" ?>" class="input">
            </div>
            <label class="form-check">
                <input type="checkbox" name="cutlery" value="true" <?= $order->cutlery ? "checked" : "" ?>>
                <span class="form-check-input"></span>
                Нужны<br> приборы
            </label>
            <div class="form-input comment">
                <p class="input-name">Дополнительные комментарии к заказу (удобное время, ориентиры для курьера, пожелания и
                    т.д.)</p>
                <input name="comment" type="text" value="<?= $order->comment ?>" class="input">
            </div>
        </div>
    </div>
    <?php if ($status == "success"): ?>
        <p class="success-message">Заявка успешно отправлена</p>
    <?php endif ?>
    <button class="btn submit-btn <?= $status ?>">
        <p>Оформить заказ</p>
    </button>
</div>