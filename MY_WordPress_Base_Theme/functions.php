<?php

// Disable the Wordpress Admin Bar.
show_admin_bar(false);

// include js scripts and styles
function add_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', ('https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'), false, null, true);
        wp_enqueue_script('jquery');

        // TODO
        wp_register_script( 'swiper', ( 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js' ), false, null, true );
        wp_enqueue_script( 'swiper' );
        wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css', 'all');

        // Don't foreget to update the dependencies array (if applicable)
        wp_enqueue_script('selectric', get_bloginfo('stylesheet_directory') . '/js/jquery.selectric.js', array('jquery'), '1.13.0', true);
        wp_enqueue_script('smoothScroll', get_bloginfo('stylesheet_directory') . '/js/smoothScroll.min.js', array(), '1.5.1', true);
        wp_enqueue_script('jquery-animsition', get_bloginfo('stylesheet_directory') . '/js/animsition.min.js', array(), '1.0.0', true);
        wp_enqueue_script('lazy-load', get_bloginfo('stylesheet_directory') . '/js/lazyload.min.js', array(), '10.19.0', true);
        wp_enqueue_script('jquery-custom', get_bloginfo('stylesheet_directory') . '/js/jquery.site.js', array('jquery'), '1.0', true);

        wp_enqueue_style('reset-style', get_bloginfo('stylesheet_directory') . '/css/reset.css');
        wp_enqueue_style('animsition-style', get_bloginfo('stylesheet_directory') . '/css/animsition.min.css');
        wp_enqueue_style('site-style', get_bloginfo('stylesheet_directory') . '/css/style.css');
    }
}
add_action('wp_enqueue_scripts', 'add_scripts');


// Add a ACF Option menu
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
    acf_set_options_page_title('Site Options');
}

// Add Support for Menus
add_theme_support('menus');
if (function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'top_menu' => 'Top menu',
            'main_menu' => 'Main Menu',
        )
    );
}

// TODO  Remove editor on pages you don't want it
function custom_remove_editor_init()
{
    // if post not set, just return
    // fix when post not set, throws PHP's undefined index warning
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_id = $_POST['post_ID'];
    } else {
        return;
    }

    $pageName = get_the_title($post_id);
    $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
    $templates = array(); // add template like this: 'template-pages/give-template.php'

    if (in_array($template_file, $templates) || strtolower($pageName) == 'home' || basename(get_page_template()) === 'page.php') { // check for default page (basename(get_page_template()) === 'page.php'
        remove_post_type_support('page', 'editor');
    }
}
add_action('init', 'custom_remove_editor_init');

//Remove script version (helps gravity form recaptcha work)
function custom_remove_script_version( $src )
{
    if (is_admin() || (stripos($src, 'recaptcha') !== false)) {
        return $src;
    }
    $parts = explode( '?', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', 'custom_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'custom_remove_script_version', 15, 1 );

//Allow SVGS
function custom_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');

add_filter('wp_check_filetype_and_ext', function ($filetype_ext_data, $file, $filename, $mimes) {
    if (substr($filename, -4) === '.svg') {
        $filetype_ext_data['ext'] = 'svg';
        $filetype_ext_data['type'] = 'image/svg+xml';
    }
    return $filetype_ext_data;
}, 100, 4);

//Remove links from images
function custom_imagelink_setup()
{
    $image_set = get_option('image_default_link_type');
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}

add_action('admin_init', 'custom_imagelink_setup', 10);

// Add logo when logging into wp-admin
function custom_login_logo()
{ ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.svg);
            padding-bottom: 30px;
            width: 280px;
            background-size: contain;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'custom_login_logo');

function custom_login_logo_url()
{
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'custom_login_logo_url');

// TODO  Make nav menu link turn active for CPTs
function menu_element_class($classes, $item)
{
    if(strtolower($item->title) == 'screenplays' && (is_post_type_archive('screenplays') || (is_single() && get_post_type(get_the_id()) == 'screenplays')))
    {
        $classes[] = "current_page_item";
    }

    return $classes;
}
add_filter('nav_menu_css_class' , 'menu_element_class' , 10 , 2);


// TODO  Remove tags submenu from posts in wp-admin menu
// add_action('admin_menu', 'my_remove_sub_menus');
// function my_remove_sub_menus() {
//     // remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
//     remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
// }

// TODO
function spinner_url( $image_src, $form )
{
    return get_bloginfo('stylesheet_directory') . '/images/loading.svg';
}
add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
add_filter( 'gform_confirmation_anchor', '__return_false' );

function ajax_on_all_forms($args){
    $args['ajax'] = true;
    return $args;
}
add_filter('gform_form_args', 'ajax_on_all_forms', 10, 1);

// Allow feature Images on certain pages
add_theme_support( 'post-thumbnails' );

// TODO  Create image sizes to use throughout size (make double).
// NOTE: Reference image (array) in custom field: $image['sizes']['540_540_image_size']; or pass size to getImageUrl()
add_image_size('short_header_image_size', 4000, 1000, true);
add_image_size('tall_header_image_size', 4000, 2000, true);
add_image_size('940_920_image_size', 940, 920, true);

// Gravity form buttons html change
add_filter( 'gform_submit_button', 'thm_submit_button', 10, 2 );
function thm_submit_button( $button, $form ) {
return "<button class='button gform_button' id='gform_submit_button_{$form['id']}'>" . ($form['button']['text'] ? $form['button']['text'] : 'Submit') . "</button>";
}
// add_filter( 'gform_previous_button', 'thm_previous_button', 10, 2 );
// function thm_previous_button( $button, $form ) {
// return "<button class='button gform_previous_button' id='gform_previous_button_{$form['id']}'>" . $form['lastPageButton']['text'] . "<div class='icon-wrapper'><span class='icon-arrow'></span></div></button>";
// }
// add_filter( 'gform_next_button', 'thm_next_button', 10, 2 );
// function thm_next_button( $button, $form ) {
// return "<button class='button gform_next_button' id='gform_next_button_{$form['id']}'>Next<div class='icon-wrapper'><span class='icon-arrow'></span></div></button>";
// }

// pull in helpers
require_once('include/helper.php');
// pull in shortcodes
require_once('include/shortcodes.php');
// pull in ajax calls
require_once('include/ajaxcalls.php');
// pull in ajax calls
require_once('include/cpt.php');
?>