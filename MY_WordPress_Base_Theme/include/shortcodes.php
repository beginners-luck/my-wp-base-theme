<?php

/**
 * Functions for shortcodes and shortcode creation. 
 * 
 * @author      Hannah Moats
 */

/**
 * Generates html for a button based on shortcode specifications.
 * 
 * @param       Array $attributes Specifies the type of button.
 * @return      String The html code for the button
 */
function generate_button($attributes)
{
    $defaults = array(
        'title' => 'Do Not Press',
        'type' => 'black-border',
        'link' => '#',
        'new' => 'no',
        'label' => '',
        'hidden' => 'false'
    );

    $atts = shortcode_atts($defaults, $attributes);

    $target = ($atts['new'] == 'yes') ? '_blank' : '_self'; 
    $popup = ($atts['new'] == 'popup') ? 'wplightbox' : ''; 
    $aria_label = ($atts['label'] == '') ? '' : 'aria-label="' . $atts['label'] . '"'; 

    ob_start();
?>
    <a class="button <?php echo $atts['type'] . ' ' . $popup  ?>"  href="<?php echo $atts['link'] ?>" <?php echo $aria_label ?> aria-hidden="<?php echo $atts['hidden'] ?>" target="<?php echo $target ?>"><?php echo $atts['title'] ?></a>
<?php
    return ob_get_clean();
}
add_shortcode('button', 'generate_button');

/**
 * Generates the current year in the four digit year format.
 * 
 * @return      String The current year.
 */
function generate_year()
{
    return date("Y");
}
add_shortcode('year', 'generate_year');

?>