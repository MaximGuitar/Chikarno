<?php
    $title_type = get_sub_field("title-type");
?>
<section class="menu-url">
    <div class="highlite highlite--red"></div>
    <div class="highlite highlite--green"></div>
    <div class="container">
        <div class="menu-url__content-wrapper">
            <div class="menu-url__content">
                <?php if ($title_type == 'h1'): ?>
                    <h1 class="menu-url__title">
                        <?= get_sub_field('menu-url_title'); ?>
                        <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" class="arrow" alt="">
                    </h1>
                <?php else: ?>
                    <a href="<?php the_permalink(214) ?>" class="menu-url__title">
                        <?= get_sub_field('menu-url_title'); ?>
                        <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" class="arrow" alt="">
                    </a>
                <?php endif ?>
                <div class="menu-url__decor-imgs">
                    <?php if (get_sub_field('menu-url_preview')): ?>
                        <img src="<?= get_sub_field('menu-url_preview'); ?>" alt="" class="img-main" loading="lazy">
                    <?php endif; ?>
                    <?php if (get_sub_field('menu-url_decor')): ?>
                        <img src="<?= get_sub_field('menu-url_decor'); ?>" alt="" class="decor" loading="lazy">
                    <?php endif; ?>
                </div>
                <img src="<?= get_bloginfo('template_url') ?>/static/images/decor-paint.png" alt="" loading="lazy"
                    class="menu-url__paint-decor">
            </div>
            <div class="menu-url__swiper-wrapper" x-data="simpleSlider">
                <div class="green-leo-pattern green-leo"></div>
                <div class="menu-url__swiper swiper" x-ref="swiper">
                    <div class="swiper-wrapper" x-data="FancyboxGallery">
                        <?php $gallery = get_sub_field('menu-url_gallery'); ?>
                        <?php foreach ($gallery as $photo): ?>
                            <a href="<?= $photo['sizes']['medium_large'] ?>" data-fancybox="gallery" class="img-container swiper-slide">
                                <img data-fancybox="menu" src="<?= $photo['sizes']['medium_large'] ?>"
                                    alt="<?= $photo['title'] ?>" class="" loading="lazy">
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="menu-url__swiper-control">
                    <div class="swiper-arrow  swiper-arrow--left" x-ref="prev">
                        <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" alt=""
                            class="fat-arrow">
                    </div>
                    <div class="menu-url__pagination" x-ref="pag"></div>
                    <div class="swiper-arrow" x-ref="next">
                        <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" alt=""
                            class="fat-arrow">
                    </div>
                </div>
            </div>
        </div>
        <?php if (get_sub_field('menu-url_menuPreview')): ?>
            <div class="menu-url__menu-list menu-list">
                <div class="menu-list__top">
                    <span class="title"><?= get_sub_field('menu-url_menu-title'); ?></span>
                    <a href="<?= get_permalink(216) ?>" class="all-dish">смотреть всё</a>
                </div>
                <div class="menu-list__list">
                    <?php $menuList = get_sub_field('menu-url_menuPreview'); ?>
                    <?php
                        foreach ($menuList as $id){
                            get_template_part("components/menu-card", null, [
                                "id" => $id
                            ]);
                        }
                    ?>
                </div>
                <a href="<?= get_permalink(214) ?>" class="all-dish all-dish--mob">смотреть всё</a>
            </div>
        <?php endif; ?>
    </div>
</section>