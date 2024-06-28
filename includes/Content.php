<?php

class Content
{
	public function __construct($option = '', $content_type = 'content')
	{
		echo '<div class="content">';
		while (empty($option) ? have_rows($content_type) : have_rows($content_type, $option)) {
			the_row();
			if (get_row_layout() == 'content-text')
				$this->text();
			elseif (get_row_layout() == 'content-files')
				$this->files();
			$layout = get_row_layout();
			get_template_part("components/content-blocks/$layout"); //создаём папку по этому пути и все блоки которые названием совпадают с гибким содержимым работают
		}
		echo '</div>';
	}


	// Обычный текст
	private function text()
	{
		echo '<div class=" container">';
		echo '<div class=" text-container">';
		echo '<div class="content-text">' . get_sub_field('text') . '</div>';
		echo '</div>';
		echo '</div>';
	}

	// Файлы
	private function files()
	{
		echo '<div class="container">';
		?>
		<div class="files">
			<?php $i = 0; ?>
			<?php while (have_rows('files')):
				$i++;
				the_row(); ?>
				<?php $file = get_file_info(get_sub_field('file')); ?>
				<a class="file" href="<?php print $file['url']; ?>" target="_blank">
					<span class="file__title">
						<?php the_sub_field('file-name'); ?>
					</span>
					<span class="file-info">
						<span class="file-info__arrow">
							<svg role="image">
								<use xlink:href="<?php bloginfo('template_url'); ?>/static/images/sprite.svg#arrow">
							</svg>
						</span>
						<span class="file-info__size">
							<?php print $file['mime'] . ' ' . $file['size']; ?>
						</span>
					</span>
				</a>
			<?php endwhile; ?>
		</div>
		<?php
		echo '</div>';
	}

}