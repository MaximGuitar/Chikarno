<?php get_header(); ?>

<section class="page page-text">
	<div class="container">
		<div class="breadcrumbs clearfix">
			<ul class="clearfix" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<?php bcn_display(); ?>
			</ul>
		</div>

		<?php if(get_field('h1') == true): ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
		<?php endif; ?>

		<?php new Content(); ?>
	</div>
</section>

<?php get_footer(); ?>
