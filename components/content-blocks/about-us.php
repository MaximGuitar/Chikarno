<section class="about-us">
    <div class="container">
        <div class="about-us__top">
            <?php if (get_sub_field('about-us_decor-pic')): ?>
                <div class="about-us__decor img-container">
                    <img src="<?= get_sub_field('about-us_decor-pic') ?>" alt="" loading="lazy">
                </div>
            <?php endif; ?>
            <div class="highlite highlite--green"></div>
            <div class="about-us__urls">
                <?php if (get_sub_field('about-us_title')): ?>
                    <div class="about-us__title">
                        <?= get_sub_field('about-us_title') ?>
                    </div>
                <?php endif; ?>
                <div class="urls-list">
                    <?php $urls = get_sub_field('about-us_urls'); ?>
                    <?php foreach ($urls as $item): ?>
                        <a href="<?= $item['about-us_urls-url'] ?>" class="urls-list__item">
                            <p><?= $item['about-us_urls-text'] ?></p>
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
                <?php if (get_sub_field('about-us_descr')): ?>
                    <div class="about-us__descr content-text text-page">
                        <?= get_sub_field('about-us_descr') ?>
                    </div>
                <?php endif; ?>
                <div class="numbers-list">
                    <?php $nums = get_sub_field('about-us_nums'); ?>
                    <?php foreach ($nums as $key => $item): ?>
                        <div class="numbers-list__item">
                            <div class="numbers-list__item-title">
                                <p><span><?= $item['about-us_nums-title'] ?></span>
                                    <?php if ($key == 0): ?>
                                         <img src="<?= get_bloginfo('template_url') ?>/static/images/star.png" alt="">
                                    <?php endif; ?>
                                </p>
                            </div>
                            <p><?= $item['about-us_nums-descr'] ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        $gallery = get_sub_field('gallery');
        get_template_part("components/about-us-slider", null, [
            "gallery" => $gallery
        ]);
    ?>
</section>