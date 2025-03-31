<?php 
$args = wp_parse_args($args, array(
    'block' => null
)); 

if ($args['block'] != null) {
    $block = $args['block']; 
    ?>
    <div class="call-to-action-block content-block <?php echo ($block['background_color'] ? $block['background_color'] . '-background' : '') ?>">
            <?php 
            if ($block['background_type'] == 'image') {
                ?>
                    <?php echo generate_image("lazy background-image", $block['background_image'], '4000_1460_image_size') ?>
                    <div class="container container-1168">
                        <div>
                            <div class="wp-content">
                                <?php echo $block['cta_content'] ?>
                            </div>
                        </div>          
                    </div>
                <?php 
            } else if ($block['background_type'] == 'color') {
                ?>
                    
                        <div class="container container-1168">
                            <div>
                                <div class="wp-content">
                                    <?php echo $block['cta_content'] ?>
                                </div>
                            </div>          
                        </div>
              
                <?php 
            }
            ?>

    </div>
    <?php 
} else {
    trigger_error("'call-to-action' block not passed to template partial.", E_USER_ERROR);
}
?>