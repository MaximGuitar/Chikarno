<div class="page-container page-container--has-bottom-offset page-<?= get_the_ID() ?>">
    <img src="<?= bloginfo("template_url") ?>/static/images/calendar-bg.jpg" alt="" loading="lazy" class="page-container__bg">
    <?php get_template_part("components/breadcrumbs") ?>
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>
    
    <?php new Content(); ?>
</div>