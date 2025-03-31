<?php 
$args = wp_parse_args($args, array(
    'gallery' => null,
    'swiper_class' => 'carouselSwiper'
)); 

$gallery = $args['gallery'];
$swiper_class = $args['swiper_class'];

if ($gallery) {
?>
    <div id="gallery-cover-image" class="container">
        <div>
            <div class="image-wrapper">
                <?php echo generate_image("background-image lazy", $gallery[0]) ?>
                <a id="gallery-toggle" class="button blue" href="#">View Gallery</a>
            </div>
        </div>
    </div>

    <div id="project-gallery">
        <a id="gallery-close" href="#">
            <span class="icon-close-thick"></span>
        </a>
        <!-- Slider main container -->
        <div class="swiper <?php echo $swiper_class ?>">
            <div class="swiper-wrapper">
            <?php 
                foreach ($gallery as $image) {
                ?>
                <div class="swiper-slide">
                    <img class="gallery-image" src="<?php  echo $image['sizes']['large']?>" alt="<?php echo $image['alt']?>" />
                    <?php 
                    if ($image['caption']) {
                    ?>
                    <p class="gallery-caption"><?php echo $image['caption'] ?></p>
                    <?php 
                    }
                    ?>
                </div>
                <?php
                }
            ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
<?php
}
?>