<?php

/**
 * Catch all for all pages. (Default template page)
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */

 /* Template Name: Page */
get_header();
?>

<!-- begin content -->
<div id="content" role="main" <?php post_class(); ?>>
	<div class="container-fluid">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="container wp-content">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
<!-- end #content -->

<?php get_footer(); ?>