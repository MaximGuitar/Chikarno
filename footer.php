
</main>

<footer class="footer">
	<?php if (!is_page(138)): ?>
		<?php get_template_part("components/content-blocks/footer-form", null, []) ?>
		<?php get_template_part("components/content-blocks/contacts-section", null, []) ?>
	<?php endif ?>

	<div class="container">
		<div class="footer__bottom">
			<p class="footer__bottom-text">(с) Все права защищены. <?= date('Y'); ?></p>
			<a href="<?php the_permalink(3); ?>" class="footer__bottom-text footer__bottom-policy"
				target="_blank">Политика
				конфиденциальности</a>
			<a class="made-by" href="https://place-start.ru" target="_blank">
				<span class="made-by__text">Сделано в</span>
				<svg role="img" class="made-by__svg">
					<use href="<?= SPRITE_PATH ?>#static-ps"></use>
				</svg>
			</a>
		</div>
	</div>
</footer>
</div>

<div id="modal-book-table" class="modal regular-modal modal-book-table" x-data="Modal">
    <div class="modal__overlay" @click.self="close('self')">
        <div class="modal__container default-form-colors">
            <button class="modal__close" @click="close('self')">
                <svg class="icon">
                    <use href="<?= SPRITE_PATH ?>#close"></use>
                </svg>
            </button>

			<h2 class="title">Забронировать стол</h2>
			<p class="text">Оставьте заявку и наш менеджер свяжется с Вами!</p>
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

<?php get_template_part("components/cart/basket-modal", null, []) ?>
<?php do_action('wp_footer'); ?>

</body>

</html>
