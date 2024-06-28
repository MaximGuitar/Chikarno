<?php
    $gallery = get_field("gallery");
?>
<div class="page-container page-container--has-bottom-offset page-<?= get_the_ID() ?>">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
    <div class="page-container__pattern green-leo-pattern green-leo"></div>
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>
    
    <?php get_template_part("components/breadcrumbs") ?>
    <section class="block-photo">
        <div class="container">
            <h1 class="title">Галерея</h1>
            <div class="block-photo__content">
                <?php if ($gallery):
                    $count_in_class = 12;
                    $count_photos = count($gallery);
                    ?>
                    <div class="block-photo__gallery-wrapper">
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
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>