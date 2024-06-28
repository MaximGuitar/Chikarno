<section class="main-banner-wrapper ">
    <div class="container-1920">
        <div class="main-banner">
            <div class="main-banner__texts">
                <p class="main-banner__title">
                    <?php the_sub_field('main-banner_title'); ?>
                </p>
                <div class="main-banner__descr">
                    <p>
                        <?php the_sub_field('main-banner_descr'); ?>
                    </p>
                </div>
                <p class="main-banner__adress">
                    <?php the_field('address', 'options'); ?>
                </p>
            </div>
            <div class="main-banner__decor">
                <div class="main-banner__text-blur">
                    <p>
                        <?= get_sub_field('main-banner_top-descr'); ?>
                    </p>
                </div>
                <svg class="main-banner__green-line">
                    <use xlink:href='<?= SPRITE_PATH ?>#static-green-line'>
                    </use>
                </svg>
                <div class="main-banner__urls">
                    <a href="<?php the_permalink(214); ?>">меню</a>
                    <a href="<?php the_permalink(220); ?>">афиша</a>
                </div>
                <div class="circle-btn" x-data="Modal" @click="open('modal-book-table')">
                    <p>
                        <?php the_sub_field('main-banner_btn-text'); ?>
                    </p>
                </div>
                <img src="<?php the_sub_field('main-banner_pic'); ?>" alt="" class="main-banner__main-img">
            </div>
        </div>
    </div>
    <?php if (have_rows("main-banner_words-Line")): ?>
        <div class="pink-line">
            <?php for ($i = 0; $i <= 2; $i++): ?>
                <div class="pink-line__content-wrapper">
                    <div class="pink-line__content">
                        <?php while (have_rows('main-banner_words-Line')):
                            the_row(); ?>
                            <?php if ((get_row_index() + 1) % 3 === 0): ?>
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/cherry.png" class="cherry" alt="">
                            <?php elseif ((get_row_index() + 1) % 2 === 0): ?>
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/heart.png" class="heart" alt="">
                            <?php else: ?>
                                <img src="<?= get_bloginfo('template_url') ?>/static/images/pepper.png" class="pepper" alt="">
                            <?php endif; ?>
                            <p>
                                <?php the_sub_field("main-banner_word-in-line") ?>
                            </p>
                        <?php endwhile; ?>

                    </div>
                </div>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>