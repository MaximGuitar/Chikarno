<?php
    use Placestart\Shop\Cart;
    use Placestart\Shop\Order;
	
	$cart = new Cart();
    $cart_items = $cart->getCartItems();
?>

<?php if (count($cart_items) > 0): ?>
<div class="page-container page-container--has-bottom-offset page-<?= get_the_ID() ?>">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
    <?php get_template_part("components/breadcrumbs") ?>
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>

    <section class="order">
        <div class="container">
            <h1 class="title">Оформление заказа</h1>
            <div class="grid">
                <form class="left-col" novalidate hx-post="/wp-admin/admin-ajax.php" hx-target="find .order-fields">
                    <input type="hidden" name="action" value="create_order">
                    <div class="order-fields">
                        <?php
                            $order = Order::createFromFields([
                                "delivery" => "courier",
                                "fio" => "",
                                "email" => "",
                                "phone" => "",
                                "city" => "",
                                "street" => "",
                                "house_number" => "",
                                "entrance" => -1,
                                "floor" => -1,
                                "office" => -1,
                                "time" => "asap",
                                "payment" => "cash",
                                "change" => -1,
                                "person_number" => -1,
                                "comment" => "",
                                "cutlery" => false
                            ]);
                            get_template_part("components/order/order-fields", null, [
                                "status" => "init",
                                "order" => $order
                            ]);
                        ?>
                    </div>
                </form>
                <div class="total-col">
                    <img src="<?= bloginfo("template_url") ?>/static/images/decor-paint.png" alt="" loading="lazy" class="paint">
                    <div class="total-info">
                        <div class="block">
                            <h3 class="block-title">Состав заказа</h3>
                            <div class="cart-items" hx-get="/wp-admin/admin-ajax.php?action=refresh_cart" hx-trigger="refresh-cart-items from:body" hx-swap="innerHTML">
                                <?php
                                    foreach ($cart_items as $cart_item_id => $item){
                                        get_template_part("components/cart/cart-item", null, [
                                            "cart_item_id" => $cart_item_id,
                                            "cart_item" => $item
                                        ]);
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="bottom">
                            <p class="total-price">Сумма заказа</p>
                            <p class="summ"><?php get_template_part("components/cart/total-cart-price", null, ["price" => $cart->getTotalPrice()]) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php endif ?>