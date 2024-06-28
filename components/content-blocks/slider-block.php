<section class="slider-block">
    <div class="highlite highlite--green"></div>
    <div class="slider-block__swiper-wrapper" x-data="mainSlider">
        <div class="slider-block__swiper swiper" x-ref="swiper">
            <div class="swiper-wrapper">
                <?php $gallery = get_sub_field('slider-block_gallery'); ?>
                <?php foreach ($gallery as $photo): ?>
                    <div class="img-container swiper-slide slider-block__slide">
                        <img src="<?= $photo['sizes']['medium_large'] ?>" alt="<?= $photo['title'] ?>" class="" loading="lazy">
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="slider-block__swiper-control">
            <div class="swiper-arrow swiper-arrow--empty swiper-arrow--left" x-ref="prev">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" alt="" class="fat-arrow">
            </div>
            <a href="#footer-form" class="btn slider-block__callback">
                <p class="desc"><?= get_sub_field('slider-block_btn-txt') ?></p>
                <p class="mob">Забронировать</p>
            </a>
            <div class="swiper-arrow swiper-arrow--empty" x-ref="next">
                <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" alt="" class="fat-arrow">
            </div>
        </div>
    </div>
</section>