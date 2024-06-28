<form hx-post="/wp-admin/admin-ajax.php" hx-swap="outerHTML" hx-indicator="find .footer-form__submit-btn" class="footer-form">
    <input type="hidden" name="action" value="book_table">
    <input placeholder="Дата" name="date" type="text" value="<?= $args["date"] ?>" class="input <?= isset($args["errors"]["date"]) ? "error" : "" ?>">
    <input placeholder="Имя" name="fio" type="text" value="<?= $args["fio"] ?>" class="input <?= isset($args["errors"]["fio"]) ? "error" : "" ?>">
    <input placeholder="Время" name="time" type="text" value="<?= $args["time"] ?>" class="input <?= isset($args["errors"]["time"]) ? "error" : "" ?>">
    <input x-data="" x-mask="+7 999 999 99 99" placeholder="Телефон" name="tel" type="tel" value="<?= $args["tel"] ?>"
        class="input <?= isset($args["errors"]["tel"]) ? "error" : "" ?>">
    <textarea value="" resize="none" placeholder="Комментарий" name="comment"
        class="input area"><?= $args["comment"] ?></textarea>
    <div class="footer-form__submit">
        <?php if ($args["status"] == "success"): ?>
            <p>Заявка успешно отправлена</p>
        <?php else: ?>
                <button class="btn footer-form__submit-btn <?= $args["status"] ?>">
                    <p>Оставить заявку</p>
                </button>
        <?php endif ?>
        <a href="/policy/" class="footer-form__policy">Нажимая на кнопку вы соглашаетесь
            на <span>&nbsp;обработку данных</span></a>
    </div>
</form>