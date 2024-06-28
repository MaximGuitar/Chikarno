<div class="page-container page-container--has-bottom-offset">
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>

    <?php
        $bg = get_post_thumb(get_the_ID(), "full");
    ?>
    <section class="page-head">
        <?php if ($bg): ?>
            <img src="<?= $bg["src"] ?>" alt="<?= $bg['alt'] ?>" class="bg">
        <?php endif ?>
        <?php get_template_part("components/breadcrumbs") ?>
    </section>
    <?php if (have_rows("words-line")): ?>
        <div class="pink-line">
            <?php for ($i = 0; $i <= 2; $i++): ?>
                <div class="pink-line__content-wrapper">
                    <div class="pink-line__content">
                        <?php while (have_rows('words-line')):
                            the_row(); ?>
                            <?php if ((get_row_index() + 1) % 3 === 0): ?>
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/cherry.png" class="cherry" alt="">
                            <?php elseif ((get_row_index() + 1) % 2 === 0): ?>
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/heart.png" class="heart" alt="">
                            <?php else: ?>
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/pepper.png" class="pepper" alt="">
                            <?php endif; ?>
                            <p>
                                <?php the_sub_field("word") ?>
                            </p>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <section class="about-us top-offset">
        <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
        <div class="container">
            <div class="about-us__top">
                <?php if (get_field('about-decor-img')): ?>
                    <div class="about-us__decor img-container">
                        <img src="<?= get_field('about-decor-img')["url"] ?>" alt="" loading="lazy">
                    </div>
                <?php endif; ?>
                <div class="highlite highlite--green"></div>
                <div class="about-us__urls">
                    <?php if (get_field('about-title')): ?>
                        <h1 class="about-us__title">
                            <?= get_field('about-title') ?>
                        </h1>
                    <?php endif; ?>
                    <div class="urls-list">
                        <?php $urls = get_field('about-links'); ?>
                        <?php foreach ($urls as $item): ?>
                            <a href="<?= $item['link'] ?>" class="urls-list__item">
                                <p><?= $item['text'] ?></p>
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" alt=""
                                    class="fat-url">
                            </a>
                        <?php endforeach ?>
                    </div>

                    <a href="#footer-form" class="btn about-us__btn">
                        <p>Резерв стола</p>
                    </a>
                </div>
                <div class="about-us__content">
                    <?php if (get_field('about-description')): ?>
                        <div class="about-us__descr content-text text-page">
                            <?= get_field('about-description') ?>
                        </div>
                    <?php endif; ?>
                    <div class="numbers-list">
                        <?php $nums = get_field('about-numbers'); ?>
                        <?php foreach ($nums as $key => $item): ?>
                            <div class="numbers-list__item">
                                <div class="numbers-list__item-title">
                                    <p><span><?= $item['zagolovok'] ?></span>
                                        <?php if ($key == 0): ?>
                                            <img src="<?= get_bloginfo('template_url') ?>/static/images/star.png" alt="">
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <p><?= $item['opisanie'] ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-block">
            <div class="highlite highlite--green"></div>
            <div class="slider-block__swiper-wrapper" x-data="mainSlider">
                <div class="slider-block__swiper swiper" x-ref="swiper">
                    <div class="swiper-wrapper">
                        <?php $gallery = get_field('slider-gallery'); ?>
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
                    <div class="btn slider-block__callback">
                        <p class="desc"><?= get_field('slider-btn-text') ?></p>
                        <p class="mob">Забронировать</p>
                    </div>
                    <div class="swiper-arrow swiper-arrow--empty" x-ref="next">
                        <img src="<?= get_bloginfo('template_url') ?>/static/images/fat-arrow.png" alt="" class="fat-arrow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php new Content() ?>

</div>