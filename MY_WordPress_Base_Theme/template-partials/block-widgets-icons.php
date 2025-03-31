<?php 
$args = wp_parse_args($args, array(
    'block' => null
)); 

if ($args['block'] != null) {
    $cards = $args['block']; 
    ?>
    <div class="multi-column-icons-block content-block container container-1168">
        <div>
            <div class="grid--2-cols">
                <?php 
                foreach ($cards as $card) {
                    ?>
                    <a <?php echo ($card['widget_link'] ? 'href="' . $card['widget_link'] . '"' : '') ?> class="card">
                        <?php 
                        if ($card['widget_video']) {
                            ?>
                            <video class="background-video" autoplay loop muted>
                                <source src="<?php echo $card['widget_video'] ?>" type="video/mp4">
                            </video>
                            <?php 
                        }
                        ?>
                        <?php echo generate_image('background-image lazy', $card['widget_image'], '1140_760_image_size') ?>
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
                    </a>
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