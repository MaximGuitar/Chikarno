<article class="post-card">
    <?php
        $img = get_post_thumb(get_the_ID(), "medium_large");
        if ($img):
    ?>
        <img src="<?= $img["src"] ?>" alt="<?= $img["src"] ?>" class="img">
    <?php endif ?>
    <h3 class="title"><?php the_title() ?></h3>
    <div class="content-text text-page"><?php the_content() ?></div>
</article>