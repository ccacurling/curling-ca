<?php
/**
 * Block Name: Image Carousel
 *
 * This is the template that displays the image carousel block.
 */

$carousel_type = get_field( 'image_carousel_type' );
$carousel_title = get_field( 'image_carousel_title' );
$carousel_layout = get_field( 'image_carousel_layout' );
$carousel_gallery = get_field( 'image_carousel_gallery' );

$carousel_gallery_chucks = array_chunk($carousel_gallery, 4);
?>

<section class="block-image-carousel js-image-carousel">
  <h3><?php echo $carousel_title; ?></h3>

  <div class="image-carousel-gallery-mobile <?php echo $carousel_layout === 'large_right' ? 'image-carousel-rtl' : ''; ?>">
      <div class="image-carousel-slides js-slider-mobile">
        <?php
          foreach ($carousel_gallery as $key => $image) {
        ?>
          <div class="image-carousel-slide">
            <div class="image-carousel-image-container">
              <img class="image-carousel-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            </div>
          </div>
        <?php
          }
        ?>
      </div>
      <div class="image-carousel-navigation js-carousel-mobile-nav">
        <div class="image-carousel-navigation-arrows">
          <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-prev js-carousel-mobile-nav-prev"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-left-nav-white.svg"; ?> alt=""/></button>
          <h4 class="image-carousel-navigation-pagination js-carousel-mobile-nav-pagination"></h4>
          <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-next js-carousel-mobile-nav-next"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-right-nav-white.svg"; ?> alt=""/></button>
        </div>
      </div>
    </div>

  <?php
    if ($carousel_type === 'normal') {
  ?>
  <div class="image-carousel-gallery <?php echo $carousel_layout === 'large_right' ? 'image-carousel-rtl' : ''; ?>">
    <div class="image-carousel-slides js-slider">
      <?php
        foreach ($carousel_gallery_chucks as $key => $image_chunks) {
      ?>
        <div class="image-carousel-slide">
          <?php
            if ($image_chunks[0]) {
          ?>
            <div class="image-carousel-image-container-left">
              <div class="image-carousel-image-container image-carousel-image-0">
                <img class="image-carousel-image" src="<?php echo $image_chunks[0]['url']; ?>" alt="<?php echo $image_chunks[0]['alt']; ?>" />
              </div>
            </div>
          <?php
            }
          ?>
            <div class="image-carousel-image-container-right">
              <?php
                for ($i = 1; $i < count($image_chunks); $i++) {
                  $image = $image_chunks[$i];
              ?>
                <div class="image-carousel-image-container image-carousel-image-<?php echo $i; ?>">
                  <img class="image-carousel-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                </div>
              <?php
                }
              ?>
            </div>
        </div>
      <?php
        }
      ?>
    </div>
    <div class="image-carousel-navigation js-carousel-nav">
      <div class="image-carousel-navigation-arrows">
        <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-prev js-carousel-nav-prev"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-left-nav-white.svg"; ?> alt=""/></button>
        <h4 class="image-carousel-navigation-pagination js-carousel-nav-pagination"></h4>
        <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-next js-carousel-nav-next"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-right-nav-white.svg"; ?> alt=""/></button>
      </div>
    </div>
  </div>

  <?php
    } else {
  ?>
  <div class="image-carousel-gallery image-carousel-gallery-circular <?php echo $carousel_layout === 'large_right' ? 'image-carousel-rtl' : ''; ?> ">
    <div class="image-carousel-slides js-slider js-slider-circular">
      <?php
        foreach ($carousel_gallery as $key => $image) {
      ?>
        <div class="image-carousel-slide">
          <div class="image-carousel-image-container">
            <img class="image-carousel-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
          </div>
        </div>
      <?php
        }
      ?>
    </div>
    <div class="image-carousel-navigation js-carousel-nav">
      <div class="image-carousel-navigation-arrows">
        <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-prev js-carousel-nav-prev"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-left-nav-white.svg"; ?> alt=""/></button>
        <h4 class="image-carousel-navigation-pagination js-carousel-nav-pagination"></h4>
        <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-next js-carousel-nav-next"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-right-nav-white.svg"; ?> alt=""/></button>
      </div>
    </div>
  </div>

  <?php
    }
  ?>
</section>