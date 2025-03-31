<div id="home-header-container" class="image-wrapper">
    <?php 
        echo generate_post_image("background-image lazy", get_the_id(), 'tall_header_image_size');
    ?>
    <div class="wp-content container">
        <?php the_field('header_content'); ?>
    </div>
</div>