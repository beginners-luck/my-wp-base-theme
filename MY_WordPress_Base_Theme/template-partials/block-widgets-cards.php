<?php 
$args = wp_parse_args($args, array(
    'block' => null
)); 

if ($args['block'] != null) {
    $cards = $args['block']; 
    ?>
    <div class="multi-column-cards-block content-block container container-1168">
        <div>
            <div class="grid--2-cols">
                <?php 
                foreach ($cards as $card) {
                    ?>
                    <div class="card">
                        <?php echo generate_image('background-image lazy', $card['widget_image'], '1140_920_image_size') ?>
                        <div class="wp-content">
                            <?php 
                            if ($card['widget_title']) {
                                ?>
                                <h3><?php echo $card['widget_title'] ?></h3>
                                <?php 
                            }
                            ?>
                            <?php echo $card['widget_content'] ?>
                        </div>
                    </div>
                    <?php 
                }
                ?>
            </div>
        </div>
    </div>
    <?php 
} else {
    trigger_error("'multi-column-cards' block not passed to template partial.", E_USER_ERROR);
}
?>