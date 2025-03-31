<?php 
/**
 * Generates the html for the content row with one image and content. 
 * 
 * @param       String $image The image html 
 * @param       String $content The content for the row
 * @param       String $position The position of the image (left or right)
 * @param       String $background The background color
 */

$args = wp_parse_args(
    $args, 
    array( 
        'block' => null,
        'img_size' => '940_920_image_size' // TODO  set default
    )
);

if ($args['block'] != null) {
    $block = $args['block']; 
    $img_pos = $block['left_image'] ? 'photo-left' : 'photo-right'; 
    $bkg_color = $block['background_color'] . '-background';
    $content = $block['content']; 
    $image = $block['image']; // image array is stored here
?>
    <div class="left-right-img-content-block content-block <?php echo $bkg_color ?>">
        <div class="container container-1168">
            <!-- Add photo-left to switch photo side -->
            <div class="one-photo-content-row <?php echo $img_pos ?>">
                <div class="content-container">
                    <div class="wp-content"><?php echo $content ?></div>
                </div>
                <div class="image-wrapper">
					<?php echo generate_image("aspect-image lazy", $image, $args['img_size'])?>
				</div>
            </div>
        </div>
    </div>
<?php 
} else {
    trigger_error("'left-right-img-content' block not passed to template partial.", E_USER_ERROR);
}
?>