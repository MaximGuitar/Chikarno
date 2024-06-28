<div class="footer-form-wrapper" id="footer-form">
    <img src="<?= get_bloginfo('template_url') ?>/static/images/dangerLine.jpg"
        class="footer-form-wrapper__dangerLine" alt="">
    <div class="container">
        <div class="footer-form-wrapper__content">
            <div class="footer-form-wrapper__texts">
                <p class="footer-form-wrapper__title">Забронировать стол</p>
                <p class="footer-form-wrapper__subtitle">Оставьте заявку и наш менеджер свяжется с Вами!</p>
            </div>
            <?php get_template_part("components/book-table-form", null, [
                "status" => "init",
                "date" => "",
                "time" => "",
                "tel" => "",
                "fio" => "",
                "comment" => ""
            ]) ?>
        </div>
    </div>
</div>