<div class="page-container page-container--has-bottom-offset page-<?= get_the_ID() ?>">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <img src="<?= bloginfo("template_url") ?>/static/images/decor-paint.png" alt="" loading="lazy" class="paint">

    <?php get_template_part("components/breadcrumbs") ?>

    <?php
        $content = get_the_content();
        $img = get_post_thumb(get_the_ID(), "medium_large");

        if ($content):
    ?>
        <section class="loyalty-program">
            <div class="container">
                <div class="text-col">
                    <div class="content-text text-page">
                        <?= wpautop($content) ?>
                    </div>
                    <div class="btn">
                        <p>зарегистрироваться</p>
                    </div>
                </div>
                <?php if ($img): ?>
                    <div class="img-col">
                        <img src="<?= $img["src"] ?>" alt="<?= $img["alt"] ?>" class="img">
                    </div>
                <?php endif ?>
            </div>
        </section>
    <?php endif ?>
</div>