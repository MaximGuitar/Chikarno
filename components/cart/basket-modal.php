<?php
	use Placestart\Shop\Cart;

	$cart = new Cart();
	$cart_items = $cart->getCartItems();
?>
<div class="basket-modal" x-data :class="$store.basket.open && 'open'" @click.self="$store.basket.open = false" @keyup.escape.window="$store.basket.open = false">
	<div class="basket-wrap">
		<div class="top">
			<p class="title" id="total-cart-count" hx-swap-oob="true">
				Корзина(<?php get_template_part("components/cart/total-cart-count", null, [
					"count" => count($cart_items)
				]) ?>)
			</p>
			<button class="close-modal" x-data @click="$store.basket.open = false">
				<svg class="icon">
					<use href="<?= SPRITE_PATH ?>#close"></use>
				</svg>
			</button>
		</div>
		<div class="middle">
			<div class="custom-scrollbar" x-data="CustomScrollbar">
				<div class="custom-scrollbar__container" x-ref="container">
					<div class="custom-scrollbar__content cart-content" id="cart-content" hx-get="/wp-admin/admin-ajax.php?action=refresh_cart" hx-trigger="refresh-cart-items from:body" hx-swap="innerHTML">
						<?php
							if (count($cart_items) > 0){
								foreach ($cart_items as $cart_item_id => $item){
									get_template_part("components/cart/cart-item", null, [
										"cart_item_id" => $cart_item_id,
										"cart_item" => $item
									]);
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom">
			<p class="price">
				<?php get_template_part("components/cart/total-cart-price", null, [
					"price" => $cart->getTotalPrice()
				]) ?>
			</p>
			<a href="<?php the_permalink(669) ?>" class="order-link">
				Оформить
				<img src="<?= get_bloginfo("template_url") ?>/static/images/fat-arrow.png" alt="">
			</a>
		</div>
	</div>
</div>