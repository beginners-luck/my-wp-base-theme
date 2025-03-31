<!-- 
Determining what page your on, on site: 
    CPT Archive: is_post_type_archive('cpt_name') 
    Blog Archive: is_home()
    404: is_404()
    Front Page: is_front_page()
    Single Blog Post: is_single()
    Single CPT Post: is_singular('cpt_name')
-->
<div id="default-header-container" class="image-wrapper">
    <?php
    // $page_title = wp_title('', FALSE);
    $page_title = get_the_title();

    // Retrieving images/titles from special fields
    if (is_404()) {
        $page_title = '404';
        echo generate_image('background-image lazy', get_field('404_header_image', 'options'), 'short_header_image_size', 'thumbnail');
    } else {
        echo generate_post_image("background-image lazy", get_the_id(), 'short_header_image_size');
    }

    ?>
    <div class="header-content container">
        <div>
            <h1>
                <?php echo $page_title; ?>
            </h1>
        </div>
    </div>
</div>