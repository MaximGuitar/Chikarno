<?php
    $description = get_field("description");
?>
<div class="page-container page-container--has-bottom-offset">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>

    <section class="reviews-section">
        <?php get_template_part("components/breadcrumbs") ?>
        <div class="container">
            <div class="grid">
                <div class="text-col">
                    <?php if ($description): ?>
                    <div class="content-text text-page">
                        <?= $description ?>
                    </div>
                    <?php endif ?>
                    <div class="links">
                        <a href="" class="link" target="_blank">
                            <img src="<?= bloginfo("template_url") ?>/static/images/yandex.svg" alt="" class="icon">
                        </a>
                        <a href="" class="link" target="_blank">
                            <img src="<?= bloginfo("template_url") ?>/static/images/2gis.svg" alt="" class="icon">
                        </a>
                        <a href="" class="link" target="_blank">
                            <img src="<?= bloginfo("template_url") ?>/static/images/google.svg" alt="" class="icon">
                        </a>
                    </div>
                </div>
                <div class="reviews-col">
                    <img src="<?= bloginfo("template_url") ?>/static/images/decor-paint.png" alt="" loading="lazy" class="paint">
                    <div class="highlite highlite--red"></div>
                    <div class="highlite2 highlite highlite--red"></div>
                    <iframe loading="lazy" src="https://yandex.ru/maps-reviews-widget/206388037815?comments"></iframe>
                </div>
            </div>
        </div>
        <?php
            $gallery = get_field('gallery');
            get_template_part("components/about-us-slider", null, [
                "gallery" => $gallery
            ]);
        ?>
    </section>
</div>