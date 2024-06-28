<section class="about-person">
    <div class="container">
        <div class="about-person__content">
            <div class="highlite highlite--green"></div>
            <?php if (get_sub_field('about-person_img')): ?>
                <div class="about-person__img">
                    <video muted loop preload="auto" loading="lazy" autoPlay playsInline src="<?= get_sub_field('about-person_img')?>" class="about-person__main-img" alt=""></video>
                    <?php if (get_sub_field('about-person_nearby')): ?>
                        <img src="<?= get_sub_field('about-person_nearby') ?>" alt="" loading="lazy" class="about-person__decor">
                    <?php endif; ?>
                    <div class="green-leo-pattern green-leo">

                    </div>
                </div>
            <?php endif; ?>
            <?php if (get_sub_field('about-person_descr')): ?>
                <div class="about-person__text">
                    <div class="title">
                        <p>
                            <?= get_sub_field('about-person_title'); ?>
                        </p>
                    </div>
                    <div class="descr content-text text-page">
                        <?= get_sub_field('about-person_descr'); ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
