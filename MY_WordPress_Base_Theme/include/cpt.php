<?php
add_action( 'init', 'register_cpts' );
function register_cpts() 
{
    register_post_type( 'ctas', array(
        'labels' => array(
        'name' => 'CTAs',
        'singular_name' => 'Call to Action',
        'add_new' => 'Add New Call to Action',
        'add_new_item' => 'Add New Call to Action',
        'edit_item' => 'Edit Call to Action',
        'new_item' => 'New Call to Action',
        'all_items' => 'All CTAs',
        'view_item' => 'View CTAs',
        'search_items' => 'Search CTAs',
        'not_found' =>  'Not found',
        'not_found_in_trash' => 'No CTAs found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'CTAs'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'supports'              => array( 'title', 'editor' ),
        'rewrite'               => array( 'slug' => 'ctas' ),
        'has_archive'           => false,
        'hierarchical'          => false,
        'show_in_nav_menus'     => false,
        'capability_type'       => 'post',
        'query_var'             => true,
        // 'menu_position'         => 3, 
        'menu_icon'             => 'dashicons-megaphone', // get_bloginfo('stylesheet_directory') . '/images/cpt-testimonials.png'
    ));
    // register_post_type( 'authors', array(
    //     'labels' => array(
    //     'name' => 'Authors',
    //     'singular_name' => 'Author',
    //     'add_new' => 'Add New Author',
    //     'add_new_item' => 'Add New Author',
    //     'edit_item' => 'Edit Author',
    //     'new_item' => 'New Author',
    //     'all_items' => 'All Authors',
    //     'view_item' => 'View Authors',
    //     'search_items' => 'Search Authors',
    //     'not_found' =>  'Not found',
    //     'not_found_in_trash' => 'No Authors found in Trash',
    //     'parent_item_colon' => '',
    //     'menu_name' => 'Authors'),
    //     'public'                => true,
    //     'show_ui'               => true,
    //     'show_in_menu'          => true,
    //     'supports'              => array( 'title', 'editor' ),
    //     'rewrite'               => array( 'slug' => 'testimonials' ),
    //     'has_archive'           => false,
    //     'hierarchical'          => false,
    //     'show_in_nav_menus'     => true,
    //     'capability_type'       => 'post',
    //     'query_var'             => true,
    //     'menu_position'         => 3, 
    //     'menu_icon'             => 'dashicons-book-alt', // get_bloginfo('stylesheet_directory') . '/images/cpt-testimonials.png'
    // ));
}

?>