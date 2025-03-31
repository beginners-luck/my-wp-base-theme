<?php

/**
 * The single post page template. Catch all for general single post page.
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */

get_header();
?>

<div id="content" role="main" <?php post_class(); ?>>
	<div class="container-fluid">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="container">
					<h2 class="post-title"><?php the_title(); ?></h2>
					<p class="post-date"><?php the_date(); ?></p>

					<!-- Other stuff -->

					<!-- Begin File Download -->
					<?php
					if (get_field('audio_download')) {
					?>
						<div class="file-download">
							<h5>Audio Download</h5>
							<a href="<?php the_field('audio_download'); ?>" download><span class="icon-download"></span></a>
						</div>
					<?php
					}
					?>
					<!-- End File Download -->

				</div>
			<?php endwhile;
		else : ?>
		<?php endif; ?>
	</div>
</div>
<!-- end #content -->

<?php get_footer(); ?>