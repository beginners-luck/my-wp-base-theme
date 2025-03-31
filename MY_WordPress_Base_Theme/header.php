<?php

/**
 * Header section of website.
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
	<?php
	if (is_front_page()) {
	?>
		<title><?php echo get_bloginfo('name'); ?></title>
	<?php
	} else {
	?>
		<title><?php wp_title('', true, 'right');
				echo ' | ' . get_bloginfo('name'); ?></title>
	<?php
	}
	?>
	<meta name="MobileOptimized" content="width" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />

	<link rel="index" title="<?php bloginfo('name'); ?>" href="<?php echo get_option('home'); ?>/" />
	<?php wp_head(); ?>
</head>

<body id="preload" <?php body_class('animsition'); ?>>

	<div class="wrap">

		<!-- Begin Alert Bar  TODO  -->
		<?php if (get_field('enable_alert_bar', 'options')) : ?>
			<!-- Only display alert bar if user selects it in site options -->
			<?php if (get_field('alert_bar_link', 'options')) : ?>
				<a id="alert-bar" href="<?php the_field('alert_link', 'options'); ?>" class="container-fluid">
					<p>
						<?php the_field('alert_bar_content', 'options'); ?>
					</p>
				</a>
			<?php else : ?>
				<div id="alert-bar" class="container-fluid">
					<p>
						<?php the_field('alert_bar_content', 'options'); ?>
					</p>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<!-- End Alert Bar -->

		<!-- Begin Main Navigation -->
		<?php get_template_part('/template-partials/navigation'); ?>
		<!-- End Main Navigation -->
		<!-- Begin header -->

		<header class="container-fluid">
			<!-- Begin header image/content  TODO  -->
			<?php
			// Get the correct header for the page type/template
			if (is_front_page()) { // front page
				get_template_part('template-partials/header', 'home');
			} else if (is_page_template('template-pages/rios-template.php')) { // specific template
				get_template_part('template-partials/header', 'rios');
			} else if (is_singular('messages')) { // message cpt
				get_template_part('template-partials/header', 'messages-single');
			} else { // I'm New, Messages, Ways to Connect, About, Events, Contact, Give, Default Template 
				get_template_part('template-partials/header', 'default');
			}
			?>
			<!-- End header image/content -->

		</header>
		<!-- End header -->