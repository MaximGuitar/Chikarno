<?php if ( isset($args["gallery"]) && count($args["gallery"]) ): ?>
<div class="about-us__bottom" x-data="aboutUsSlider">
    <div class="highlite highlite--green"></div>
    <div class="about-us__swiper swiper" x-ref="swiper">
        <div class="about-us__swiper-wrapper swiper-wrapper" x-data="FancyboxGallery">
            <?php foreach ($args["gallery"] as $photo): ?>
                <a target="_blank" data-fancybox="gallery" href="<?= $photo['url'] ?>"
                    class="swiper-slide about-us__swiper-slide">
                    <img src="<?= $photo['sizes']['medium_large'] ?>" loading="lazy">
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php endif ?>