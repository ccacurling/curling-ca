<?php
/**
 * Block Name: Sponsors
 *
 * This is the template that displays the sponsors block.
 */

  $block_title = get_field( 'block_title');
  $block_background = get_field( 'block_background_color');
  $block_background_mobile = get_field( 'block_background_color_mobile');
  $block_content_alignment = get_field( 'block_content_alignment');
  $sponsor_columns = get_field( 'sponsor_columns');

  // Handle background selection classes
  $block_background_class = $block_background === 'White' ? 'has-white-bg' : 'has-grey-bg';
  $block_background_class .= $block_background_mobile === 'White' ? ' white-bg-on-mobile' : ' grey-bg-on-mobile';

  // Handle alignment selection classes
  switch ($block_content_alignment) {
    case 'Left-Aligned':
      $content_alignment_class = 'content-left-aligned';
      break;
    case 'Centered':
      $content_alignment_class = 'content-centered';
      break;
    case 'Right-Aligned':
      $content_alignment_class = 'content-right-aligned';
      break;
    default:
      $content_alignment_class = 'content-centered';
  }

  // Handle column selection classes
  switch ($sponsor_columns) {
    case '1':
      $block_template_class = 'one-column';
      break;
    case '2':
      $block_template_class = 'two-columns';
      break;
    case '3':
      $block_template_class = 'three-columns';
      break;
    case '4':
      $block_template_class = 'four-columns';
      break;
    case '5':
      $block_template_class = 'five-columns';
      break;
    default:
      $block_template_class = '';
  }

?>

<section class="block-sponsors <?php echo $block_background_class; ?> <?php echo $block_template_class; ?>">
  <div class="sponsors-content content-fixed">
    <?php
      if ($sponsor_columns == 1) {
    ?>
      <h3><?php echo strtoupper( $block_title ); ?></h3>
    <?php
      } else {
    ?>
      <h2><?php echo strtoupper( $block_title ); ?></h2>
    <?php
      }
    ?>

    <!-- Block CTAs show if Top location is selected -->
    <?php if ( have_rows( 'block_cta_settings' ) ) { 
      while ( the_repeater_field( 'block_cta_settings' ) ) { 
        $cta_tag_line = get_sub_field( 'cta_tag_line' );
        $cta_location = get_sub_field( 'cta_location' ); ?>

        <?php if ( $cta_location === 'Top' ) { ?>

          <div class="cta-section top">
        
            <?php if ($cta_tag_line) { ?>
              <p><?php echo $cta_tag_line ?></p>
            <?php } ?>
        
            <?php if ( have_rows( 'ctas' ) ) { 
              while ( the_repeater_field( 'ctas' ) ) { 
                $cta_text  = get_sub_field( 'cta_text' ); 
                $page_link = get_sub_field( 'page_link' );
                $link_url  = get_sub_field( 'link_url' ); 
                $target    = get_sub_field( 'link_target' ); ?>
        
                <a class="cta-link" href="<?php echo $link_url ? $link_url : $page_link ?>" target="<?php echo $target ?>">
                  <?php echo strtoupper( $cta_text ); ?> <img src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="red-arrow" />
                </a>
        
              <?php } ?>
            <?php } ?> 
            
          </div>

        <?php } ?>
      <?php } ?>
    <?php } ?>
  
    <!-- Sponsors section -->
    <div class="<?php echo $content_alignment_class; ?>">
      <div class="sponsors-section <?php echo $block_template_class ?>">
    
        <?php if ( have_rows( 'sponsors' ) ) { 
          while ( the_repeater_field( 'sponsors' ) ) {
          $sponsor_type = get_sub_field( 'type' );
          $sponsor_link = get_sub_field( 'sponsor_cta' );
          $sponsor      = get_sub_field( 'sponsor' ); 
          $sponsor_link_cta = get_field( 'sponsor_link', $sponsor ); 
          $logo_src     = get_the_post_thumbnail_url( $sponsor );
          $sponsor_container_classes = 'sponsor-container';
          if ($sponsor_link) {
            $sponsor_container_classes .= $sponsor_type && $sponsor_link ? ' has-title-and-link' : '';
          } else {
            $sponsor_container_classes .= ' has-title';
          } ?>
    
          <div class="<?php echo $sponsor_container_classes ?>">
  
            <?php if ($sponsor_type) { ?>
              <h3><?php echo strtoupper( $sponsor_type ); ?></h3>
            <?php } ?>
            
            <?php if ($sponsor_link) { ?>
              <a class="sponsor-container-link" href="<?php echo $sponsor_link['url']; ?>" target="<?php echo $sponsor_link['target']; ?>">
                <?php echo strtoupper( $sponsor_link['title'] ); ?> <img src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="red-arrow" />
              </a>
            <?php } ?>
      
            <?php
              if ($sponsor_link_cta) {
                ?>
              <a href="<?php echo $sponsor_link_cta; ?>" target="_blank">
                  <?php
              }
              ?>
              <div class="sponsor">
                <?php
                  if ($sponsor) {
                ?>
                  <img src="<?php echo $logo_src; ?>" alt="<?php echo $sponsor->post_title; ?>" />
                <?php
                  }
                ?>
              </div>
            <?php
              if ($sponsor_link_cta) {
            ?>
              </a>
            <?php
              }
            ?>
  
          </div>
    
          <?php } ?>
    
        <?php } else { ?>
          <h3>No sponsors selected</h3>
        <?php } ?>
    
      </div>
    </div>
  
    <!-- Block CTAs show if Bottom location is selected -->
    <?php if ( have_rows( 'block_cta_settings' ) ) { 
      while ( the_repeater_field( 'block_cta_settings' ) ) { 
        $cta_tag_line = get_sub_field( 'cta_tag_line' );
        $cta_location = get_sub_field( 'cta_location' ); ?>

        <?php if ( $cta_location === 'Bottom' ) { ?>

          <div class="cta-section bottom">
        
            <?php if ($cta_tag_line) { ?>
              <p><?php echo $cta_tag_line ?></p>
            <?php } ?>
        
            <?php if ( have_rows( 'ctas' ) ) { 
              while ( the_repeater_field( 'ctas' ) ) { 
                $cta_text  = get_sub_field( 'cta_text' ); 
                $page_link = get_sub_field( 'page_link' );
                $link_url  = get_sub_field( 'link_url' ); 
                $target    = get_sub_field( 'link_target' ); ?>
        
                <a class="cta-link" href="<?php echo $link_url ? $link_url : $page_link ?>" target="<?php echo $target ?>">
                  <?php echo strtoupper( $cta_text ); ?> <img src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="red-arrow" />
                </a>
        
              <?php } ?>
            <?php } ?> 
            
          </div>

        <?php } ?>
      <?php } ?>
    <?php } ?>
  </div>
</section>
