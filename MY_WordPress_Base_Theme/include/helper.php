<?php

/**
 * Retrieves the featured image url based on the post id and size.
 * 
 * @param       String $id The id of the post where the image is located.
 * @param       String $size The size of the image.
 * @return      String The url for the image.   
 */
function get_post_image_url($id, $size = "full")
{
    $img_id = get_post_thumbnail_id($id);
    $url = wp_get_attachment_image_url($img_id, $size);
    return esc_url($url);
}

/**
 * Retrieves the featured image url based on the post id and size.
 * 
 * @param       String $id The id of the post where the image is located.
 * @return      String The alternative text for the image.   
 */
function get_post_image_alt($id)
{
    $img_id = get_post_thumbnail_id($id);
    $alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
    return esc_attr($alt);
}

/**
 * Generates the html for a basic img given the id of a post
 * 
 * @param       String $classes The classes to attach to the image (add 'space' between classes)
 * @param       Array $post_id The id of the post the thumbnail image is a part of
 * @param       String $size The final size of the image to be displayed
 * @param       String $size_low The size for the placeholder image before the image is lazy loaded
 */
function generate_post_image($classes = "lazy", $post_id, $size = '', $size_low = 'thumbnail')
{
    $alt_text = get_post_image_alt($post_id); // Alternative text
    $data_src = ($size == '') ? get_post_image_url($post_id) : get_post_image_url($post_id, $size); // Loaded image
    $src = get_post_image_url($post_id, $size_low); // Low quality image as placeholder

    ob_start();
?>
    <img class="<?php echo $classes ?>" alt="<?php echo $alt_text ?>" data-src="<?php echo $data_src ?>" src="<?php echo $src ?>" />
<?php
    return ob_get_clean();
}

/**
 * Generates the hrml for a basic img given an image as an array.
 * 
 * @param       String $classes The classes to attach to the image (add 'space' between classes)
 * @param       Array $image The array containing image data (typycally gotten from the field)
 * @param       String $size The final size of the image to be displayed
 * @param       String $size_low The size for the placeholder image before the image is lazy loaded
 */
function generate_image($classes = "lazy", $image = array(), $size = '', $size_low = 'thumbnail')
{
    $alt_text = esc_attr($image['alt']); // Alternative text
    $data_src = ($size == '') ? esc_url($image['url']) : esc_url($image['sizes'][$size]); // Loaded image
    $src = esc_url($image['sizes'][$size_low]); // Low quality image as placeholder

    ob_start();
?>
    <img class="<?php echo $classes ?>" alt="<?php echo $alt_text ?>" data-src="<?php echo $data_src ?>" src="<?php echo $src ?>" />
<?php
    return ob_get_clean();
}