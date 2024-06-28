<?php
    use Placestart\Shop\Product;

    $product = new Product($args["id"]);
?>
<div class="menu-card">
    <div class="img-container menu-card__container">
        <img src="<?= $product->getPreviewPicture()["src"] ?>" alt="" loading="lazy">
    </div>
    <div class="menu-card__info">
        <div class="menu-card__title">
            <p>
                <a href="<?= $product->getPermalink() ?>"
                    class="link-cover"><?= $product->getTitle() ?></a>
            </p>
        </div>
        <div class="menu-card__bottom">
            <?php if ($product->getWeight()): ?>
                <div class="weight">
                    <?= $product->getWeight() . ' гр'; ?>
                </div>
            <?php endif; ?>
            <form hx-post="/wp-admin/admin-ajax.php" hx-swap="none" class="menu-card__trade">
                <input type="hidden" name="action" value="update_count_or_add">
                <input type="hidden" name="count" value="1">
                <input type="hidden" name="product_id" value="<?= $product->getID() ?>">
                <?php if ($product->getPrice()): ?>
                    <div class="price">
                        <?= $product->getPrice() . ' ₽'; ?>
                    </div>
                <?php endif; ?>
                <button class="add-cart">
                    <svg>
                        <use href='<?= SPRITE_PATH ?>#cart2'></use>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>