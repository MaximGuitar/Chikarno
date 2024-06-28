<?php
    $term = get_queried_object();
    $desc = get_the_archive_description();

    $categories = get_terms([
        "taxonomy" => "type-menu",
        "hide_empty" => false
    ]);
?>
<div class="page-container page-container--has-bottom-offset">
    <?php get_template_part("components/breadcrumbs") ?>
    <div class="page-container__highlite1 highlite highlite--green"></div>
    <div class="page-container__highlite2 highlite highlite--green"></div>
    <div class="page-container__highlite3 highlite highlite--red"></div>
    <div class="page-container__highlite4 highlite highlite--red"></div>

    <div class="menu-section">
        <div class="container">
            <div class="head">
                <h1 class="title"><?php the_title() ?></h1>
            </div>
            <?php if ($categories): ?>
                <div class="menu-list__list" hx-boost="true" hx-select=".page-container" hx-target=".page-container" hx-swap="outerHTML">
                    <?php
                        foreach ($categories as $category):
                            $img = get_field("category-img", $category);
                    ?>
                        <div class="category-card">
                            <?php if ($img): ?>
                                <img class="img" alt="<?= $img["alt"] ?>" src="<?= $img["sizes"]["medium_large"] ?>">
                            <?php else: ?>
                                <div class="img no-img"></div>
                            <?php endif ?>
                            <a href="<?= get_term_link($category) ?>" class="name link-cover"><?= $category->name ?></a>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>