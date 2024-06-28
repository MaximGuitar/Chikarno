<?php get_header(); ?>
<?php
    use Placestart\Shop\Product;

    $id = get_the_ID();
    $product = new Product($id);
    $img = $product->getPreviewPicture();
?>
<div class="page-container page-container--has-bottom-offset">
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>
    <section class="product-section">
        <div class="grid container">
            <?php get_template_part("components/breadcrumbs") ?>
            <div class="text-col">
                <div class="content-text text-page">
                    <h1><?= $product->getTitle() ?></h1>
                    <?= $product->getDescription() ?>
                </div>
                <form hx-post="/wp-admin/admin-ajax.php" hx-swap="none">
                    <input type="hidden" name="action" value="update_count_or_add">
                    <input type="hidden" name="count" value="1">
                    <input type="hidden" name="product_id" value="<?= $product->getID() ?>">
                    <button class="btn cart-btn">
                        <p>в корзину</p>
                    </button>
                </form>
            </div>
            <div class="image-col">
                <?php if ($img): ?>
                    <img src="<?php bloginfo("template_url") ?>/static/images/decor-paint.png" alt="" loading="lazy" class="paint">
                    <img src="<?= $img["src"] ?>" alt="<?= $img["alt"] ?>" class="img">
                <?php endif ?>
            </div>
        </div>
    </section>
    <section class="other-products-section">
        <div class="container">
            <h2 class="title">Также заказывают</h2>
            <div class="menu-list__list">
                <?php
                    $other_products_query = new WP_Query([
                        "post_type" => "dish",
                        "posts_per_page" => 4,
                        "orderby" => "rand"
                    ]);

                    while ($other_products_query->have_posts()){
                        $other_products_query->the_post();
                        $id = get_the_ID();

                        
                        get_template_part("components/menu-card", null, [
                            "id" => $id
                        ]);
                    }
                ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>