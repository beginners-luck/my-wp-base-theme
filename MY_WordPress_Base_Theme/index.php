<?php

/**
 * Used as the "archive" page for blog posts. Only cpts use the archive templates
 * as their archive page.
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */

get_header();
?>
<div id="content" role="main">
	<div class="container-fluid">
		<!-- Begin listing posts in archive -->
		<?php
		// Protect against arbitrary paged values
		$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
		// Retrieving the sermons after the featured sermon
		$newsPosts = new WP_Query(array(
			'post_status' => 'publish',
			// 'posts_per_page' is set in Settings > Reading
			'paged' => $paged,
		));
		?>
		<?php if ($newsPosts->have_posts()) { ?>
			<div id="archive-list" class="container">
				<div>
					<?php while ($newsPosts->have_posts()) : $newsPosts->the_post(); ?>
						<div class="post-item gray-background wp-content">
							<?php echo generate_post_image("lazy", get_the_id(), 'short_header_image_size'); ?>
							<h2 class="message-title"><?php the_title(); ?></h2>
							<h3 class="message-date"><?php the_time('F j, Y'); ?></h3>
							<a class="button arrow" href="<?php the_permalink(); ?>">Keep Reading</a>
						</div>
					<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>

			<?php if ($newsPosts->max_num_pages > 1) {
				$big = 999999999; // need an unlikely integer

				// Begin Pagination setup
				echo '<div id="pagination">';
				echo paginate_links(array(
					'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format' => '?paged=%#%',
					'current' => max(1, get_query_var('paged')),
					'prev_next' => true,
					'total' => $newsPosts->max_num_pages,
					'prev_text' => '<span class="icon-arrow"></span>',
					'next_text' => '<span class="icon-arrow"></span>'
				));
				echo '</div>';
				// End Pagination setup
			}
		} else { ?>
			<div id="alert-message" class="container">
				<p>No messages available at this time.</p>
			</div>
		<?php } ?>
		<!-- End listing posts in archive -->

	</div>
</div>

<?php get_footer(); ?>