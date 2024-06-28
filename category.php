<?php get_header(); ?>
<div class="page-container page-container--has-bottom-offset">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
    <div class="page-container__pattern green-leo-pattern green-leo"></div>
    <?php get_template_part("components/breadcrumbs") ?>
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>
    
    <section class="category-section">
        <div class="container">
            <h1 class="category-section__title">Акции</h1>
            <div class="category-section__grid">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part("components/post-card") ?>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>