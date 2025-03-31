<?php

/**
 * 404 error page of website.
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */

get_header();
?>

<!-- begin content -->
<div id="content" role="main" <?php post_class(); ?>>
	<div class="container-fluid">
		<div class="container wp-content">
			<?php the_field('404_content', 'options'); ?>
		</div>
	</div>
</div>
<!-- end #content -->

<?php get_footer(); ?>