<?php
/**
 * @var int $cart_item_id ID позиции в корзине
 * @var CartItem $cart_item Объект товара в корзине
*/

use Placestart\Shop\CartItem;

$cart_item_id = $args["cart_item_id"];
$cart_item = $args["cart_item"];

$product = $cart_item->getProduct();
$img = $product->getPreviewPicture();
?>
<div class="cart-item">
    <?php if ($img): ?>
        <img src="<?= $img["src"] ?>" alt="<?= $img["alt"] ?>" class="picture">
    <?php endif ?>
    <div class="info">
        <p class="name">
            <a class="link-cover" href="<?= $product->getPermalink() ?>"><?= $product->getTitle() ?></a>
        </p>
        <p class="weight"><?= $product->getWeight() ?> гр</p>
    </div>
    <form hx-post="/wp-admin/admin-ajax.php" class="delete" hx-swap="none" hx-trigger="submit">
        <input type="hidden" name="product_id" value="<?= $cart_item_id ?>">
        <input type="hidden" name="action" value="remove_product">
        <button class="delete-btn">
            <svg class="icon">
                <use href="<?= SPRITE_PATH ?>#close"></use>
            </svg>
        </button>
    </form>
    <form class="price-row" hx-post="/wp-admin/admin-ajax.php" hx-swap="none" hx-trigger="submit delay:250ms">
        <input type="hidden" name="cart_item_id" value="<?= $cart_item_id ?>">
        <input type="hidden" name="action" value="set_count">
        <div class="count-input" x-data="{count: <?= $cart_item->getCount() ?>}">
            <input type="hidden" name="count" :value="count">
            <button class="minus" @click="count -= 1">-</button>
            <p class="count" x-text="`${count} шт`"></p>
            <button class="plus" @click="count += 1">+</button>
        </div>
        <p class="price"><?= $product->getPrice() ?> Р</p>
    </form>
</div>