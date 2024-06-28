<section class="block-photo">
    <div class="container">
        <div class="block-photo__content">
            <?php if (get_sub_field('block-photos_title')): ?>
                <div class="block-photo__title">
                    <?= get_sub_field('block-photos_title') ?>
                </div>
            <?php endif; ?>
            <?php if (get_sub_field("block-photos_btn-text")): ?>
                <a href="#footer-form" class="btn block-photo__btn">
                    <p><?= get_sub_field("block-photos_btn-text") ?></p>
                </a>
            <?php endif ?>
            <?php if (get_sub_field('block-photos_gallery')):
                $gallery = get_sub_field('block-photos_gallery');
                $count_in_class = 12;
                $count_photos = count($gallery);
                ?>
                <div class="block-photo__gallery-wrapper">
                    <div class="highlite1 highlite highlite--green"></div>
                    <div class="highlite2 highlite highlite--green"></div>
                    <div class="highlite3 highlite highlite--red"></div>
                    <div class="highlite4 highlite highlite--red"></div>
                    <?php if ($gallery): ?>
                        <?php while ($count_photos > 0): ?>
                            <div class="block-photo__gallery" x-data="FancyboxGallery">
                                <?php $counter = 0;
                                while ($counter < $count_in_class && $count_photos > 0): ?>
                                    <a data-fancybox="gallery" href="<?= ($gallery[$count_photos - 1]['sizes']['medium_large']); ?>"
                                        class="img-container block-photo__img-container">
                                        <img src="<?= ($gallery[$count_photos - 1]['sizes']['medium_large']); ?>" loading="lazy"
                                            alt="<?= $gallery[$count_photos - 1]['title'] ?>">
                                    </a>
                                    <?php $count_photos--;
                                    $counter++;
                                endwhile; ?>
                            </div>
                        <?php endwhile ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if (get_sub_field('block-photos_text-url')): ?>
                <a href="<?php the_permalink(204); ?>" class="block-photo__seeAll"><?= get_sub_field('block-photos_text-url') ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>