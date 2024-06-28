<?php
    $gallery = get_sub_field('gallery');
?>
<section class="slider-section">
    <?php get_template_part('components/about-us-slider', null, ["gallery" => $gallery]) ?>
</section>