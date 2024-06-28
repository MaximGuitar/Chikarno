<section class="advantages">
    <img src="<?= get_bloginfo('template_url') ?>/static/images/dangerLine2.png" alt="" class="advantages__decor">
    <div class="container advantages__container" class="advantages__content">
        <?php if (get_sub_field('advantages_title')): ?>
            <div class="advantages__title">
                <?= get_sub_field('advantages_title') ?>
            </div>
        <?php endif; ?>
        <div class="advantages-list">
            <div class="advantages-list__booking-wrapper">
                <a href="#footer-form" class="btn advantages-list__booking">
                    <p>Скорее бронируй!</p>
                </a>
                <div class="img-container advantages-list__decor">
                    <img src="<?= get_bloginfo('template_url') ?>/static/images/decor-paint.png" alt="">
                </div>
            </div>
            <?php $advList = get_sub_field('advantages_list'); ?>
            <?php foreach ($advList as $advantages): ?>
                <div class="advantages-list__item">
                    <p><?= $advantages['advantages-item-text'] ?></p>
                    <div class="img-container  advantages-list__item-img">
                        <img src="<?= $advantages['advantages-item-pic'] ?>" alt="">
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>