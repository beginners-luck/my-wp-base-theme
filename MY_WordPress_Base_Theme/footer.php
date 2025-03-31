<?php

/**
 * Footer section of website.
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */
?>
<div class="push"></div>
</div> <!-- end .wrap -->

<!-- Begin Global CTA Element -->
<?php 
if (is_post_type_archive('projects')) {
	$cta = get_field('call_to_action', 'cpt_projects');
} else if (is_home()) {
	$cta = get_field('posts_call_to_action', 'options'); 
} else {
	$cta = get_field('call_to_action');
}
wp_reset_postdata();
if ($cta) {
	$cta_id = $cta[0]; 
	?>
	<div id="call-to-action">
		<div class="container">
			<div>
				<div class="wp-content">
					<?php echo get_post_field('post_content', $cta_id) ?>
				</div>
			</div>
		</div>
	</div>
	<?php 
}
?>
<!-- End Global CTA Element -->

<!-- Begin Footer -->
<footer class="container-fluid">

	<!-- Begin top footer bar -->
	<div id="top-footer-bar">
		<div class="container">
			<div>
				<div class="wp-content">
					<?php the_field('address', 'options'); ?>
				</div>

				<!-- Social Media icons -->
				<?php
				if (get_field('social_media_platforms', 'options')) {
				?>
					<div class="social-icons">
						<?php
						foreach (get_field('social_media_platforms', 'options') as $icon) {
						?>
							<a class="social-icon-link" href="<?php echo $icon['social_link'] ?>" target="_blank">
								<img class="icon" src="<?php echo $icon['social_icon']['url'] ?>" />
							</a>
						<?php
						}
						?>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
	<!-- End top footer bar -->

	<!-- Begin bottom footer bar -->
	<div id="bottom-footer-bar">
		<div class="container">
			<div>
				<div class="left-content-container">
					<?php the_field('copyright', 'options'); ?>
				</div>
		
				<div class="right-content-container">
					<a href="https://cacpro.com" target="_blank">Handcrafted <span class="icon-cacpro"></span></a>
				</div>
			</div>
		</div>
	</div>
	<!-- End bottom footer bar -->

</footer>

<?php wp_footer(); ?>
</body>

</html>
<!-- End Footer -->