<?php

/**
 * Generates the html for an accordion content block.
 * 
 * @param       String $title The main title of the accordion
 * @param       Array $rows A 2D array of containing the 'question' and 'answer' for each item in the accordion
 * @param       String $background_class The class name for the background of the accordion element
 * @param       Boolean $open_first_row True if the first item/row in the accordion is open on page load
 */

$args = wp_parse_args(
    $args,
    array(
        'block' => null,
        'open' => false //Set true if first row of accordion is opened
    )
);

if ($args['block'] != null) {
    $block = $args['block'];
    $main_title = $block['accordions_main_title'];
    $accordions = $block['accordions'];
    $open_first_accordion = $args['open'] ? 'opened-accordion' : '';
    $first_accordion_display = ($open_first_accordion) ? ' style="display: block;" ' : '';

    if (count($accordions) != 0) {
?>
        <div class="accordions-block content-block container container-968">
            <div>
                <?php
                if ($main_title) {
                ?>
                    <h2 class="main-title"> <?php echo $main_title; ?> </h2>
                <?php
                }

                foreach ($accordions as $accordion) {
                    if ($accordion != $accordions[0]) { // not first accordion
                        $open_first_accordion = '';
                        $first_accordion_display = '';
                    }
                ?>
                    <div class="accordion-item-container <?php echo $open_first_accordion ?>">
                        <button class="title-container accordion-toggle">
                            <p class="subheading title"><?php echo $accordion['accordion_title'] ?></p>
                            <span class="icon-accordion-open"></span>
                            <span class="icon-accordion-close"></span>
                        </button>
                        <div class="content wp-content" <?php echo $first_accordion_display ?>>
                            <?php echo $accordion['accordion_content'] ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
} else {
    trigger_error("'accordions' block not passed to template partial.", E_USER_ERROR);
}
?>