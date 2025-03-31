<?php

/**
 * Catch all for all pages. (Default template page)
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */

get_header();
?>

<!-- begin content -->
<div id="content" role="main" <?php post_class(); ?>>
	<div id="page-builder-container" class="container-fluid">
		<?php if (get_field('build_your_page')) {
			foreach (get_field('build_your_page') as $block) {
				if ($block['block_type'] == 'content') {
		?>
					<div class="content-block container container-968">
						<div>
							<div class="wp-content">
								<?php echo $block['content_block'] ?>
							</div>
						</div>
					</div>
				<?php
				} else if ($block['block_type'] == 'left_right_content_image') {
					// get_template_part('template-partials/block', 'left-right-img-content', array('block' => $block['left_right_content_image_block'], 'size' => '940_920_image_size'));
				} else if ($block['block_type'] == 'call_to_action_banner') {
					// get_template_part('template-partials/block', 'call-to-action', array('block' => $block['call_to_action_banner_block']));
				} else if ($block['block_type'] == 'multi_column_cards') {
					// get_template_part('template-partials/block', 'widgets-cards', array('block' => $block['multi_column_cards_block']));
				} else if ($block['block_type'] == 'multi_column_icon_widget') {
					// get_template_part('template-partials/block', 'widgets-icons', array('block' => $block['multi_column_widgets_block']));
				} else if ($block['block_type'] == 'accordions') {
					// get_template_part('template-partials/block', 'accordions', array('block' => $block['accordions_block']));
				} else if ($block['block_type'] == 'testimonial_slider') {
					// get_template_part('template-partials/block', 'testimonials', array('block' => $block['testimonials_slider_block']));
				}
			}
		} ?>
	</div>
</div>
<!-- end #content -->

<?php get_footer(); ?>