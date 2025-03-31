<?php

/**
 * The archive for the cpt. 
 * 
 * @version 	1.0
 * @author		Hannah Moats
 */

get_header();
?>
<div id="content" role="main">
    <div class="container-fluid">

        <?php
        // TODO  Retreiving the most recent cpt to feature it at the top
        $recent_sermon = wp_get_recent_posts(array(
            'numberposts' => 1,
            'post_status' => 'publish',
            'posts_per_page' => 9, // Can be set here if different from wordpress setting
            'post_type' => 'cpt'
        ));

        /* Using offset with pagination: https://stackoverflow.com/questions/41786703/pagination-doesnt-work-when-offset-is-set-in-wordpress */
        $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
        $current_page = get_query_var('paged');
        $current_page = max(1, $current_page);
        ?>


        <?php if ($current_page == 1) : ?>
            <?php foreach ($recent_sermon as $sermon) : ?>
                <!-- Begin Most Recent Post -->
                <h2><?php echo $sermon['post_title']; ?></h2>
                <p><?php echo date('F j, Y', strtotime($sermon['post_date'])); ?></p>
                <?php get_the_post_thumbnail_url($sermon['ID'], "full") ?>
                <a href="<?php echo get_permalink($sermon['ID']) ?>">Link to Post</a>
                <!-- End Most Recent Post -->
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
        <?php else : ?>
            <!-- Begin no most recent post -->
            <div class="no-recent-sermon">

            </div>
            <!-- End no most recent post -->
        <?php endif; ?>

        <!-- Begin listing posts in archive -->
        <?php
        /* (continued) Using offset with pagination: https://stackoverflow.com/questions/41786703/pagination-doesnt-work-when-offset-is-set-in-wordpress */
        $per_page = 9; // posts_per_page or get_option('posts_per_page') if posts_per_page not set in query
        $offset_start = 1;
        $offset = ($current_page - 1) * $per_page + $offset_start;

        // Retrieving the sermons after the featured sermon
        $sermons = new WP_Query(array(
            'post_type' => 'messages',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'offset' => $offset,
            'paged' => $current_page // protects against arbitrary paged values
        ));

        $total_rows = max(0, $sermons->found_posts - $offset_start);
        $total_pages = ceil($total_rows / $per_page);
        ?>
        <?php if ($sermons->have_posts()) : ?>
            <div id="archive-list" class="container">
                <div>
                    <?php while ($sermons->have_posts()) : $sermons->the_post(); ?>
                        <div class="post-item">
                            <a class="message-link" href="<?php the_permalink(); ?>">
                                <div class="image-wrapper">
                                    <?php echo generate_post_image("background-image lazy", get_the_id(), 'short_header_image_size'); ?>
                                </div>
                                <h4 class="message-title"><?php the_title(); ?></h4>
                                <p class="message-date"><?php the_time('F j, Y'); ?></p>
                            </a>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

            <?php
            if ($total_pages > 1) {
                $big = 999999999; // need an unlikely integer

                // Begin Pagination setup
                echo '<div id="pagination" class="blue-background">';
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => $current_page,
                    'prev_next' => true,
                    'total' => $total_pages,
                    'prev_text' => '<span class="icon-arrow-blue"></span>',
                    'next_text' => '<span class="icon-arrow-blue"></span>'
                ));
                echo '</div>';
                // End Pagination setup
            }
            ?>
        <?php else : ?>
            <div id="alert-message">
                <p>No messages available at this time.</p>
            </div>
        <?php endif; ?>
        <!-- End listing posts in archive -->

    </div>
</div>

<?php get_footer(); ?>