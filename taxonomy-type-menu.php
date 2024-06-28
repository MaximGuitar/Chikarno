<?php get_header() ?>

<?php
    $term = get_queried_object();
    $desc = get_the_archive_description();

    $query = new WP_Query([
        "post_type" => "dish",
        "posts_per_page" => -1,
        "tax_query" => [
            [
                "taxonomy" => "type-menu",
                "field" => "id",
                "terms" => $term->term_id
            ]
        ]
    ]);

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
    
    <section class="menu-section">
        <div class="container">
            <div class="categories-list" hx-boost="true" hx-select=".page-container" hx-target=".page-container" hx-swap="outerHTML">
                <?php foreach ($categories as $category): ?>
                    <a href="<?= get_term_link($category) ?>" class="categories-list__item <?= $category->term_id == $term->term_id ? "active" : "" ?>">
                        <?= $category->name ?>
                    </a>
                <?php endforeach ?>
            </div>
            <div class="head">
                <h1 class="title"><?= $term->name ?></h1>
                <div class="content-text text-page">
                    <?= $desc ?>
                </div>
            </div>
            <?php if ($query->have_posts()): ?>
                <div class="menu-list__list">
                    <?php
                        while ($query->have_posts()){
                            $query->the_post();
                            get_template_part("components/menu-card", null, [
                                "id" => get_the_ID()
                            ]);
                        }
                    ?>
                </div>
            <?php endif ?>
            <div class="categories-list" hx-boost="true">
                <?php foreach ($categories as $category): ?>
                    <a href="<?= get_term_link($category) ?>" class="categories-list__item <?= $category->term_id == $term->term_id ? "active" : "" ?>">
                        <?= $category->name ?>
                    </a>
                <?php endforeach ?>
            </div>
        </div>
    </section>
</div>

<?php get_footer() ?>