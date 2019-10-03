<?php
/**
 * Block Name: Callout
 *
 * This is the template that displays the callout block.
 */

  $callout_image = get_field( 'callout_image' );
  $callout_title = get_field( 'callout_title' );
  $callout_body_text = get_field( 'callout_body_text' );
  $callout_link = get_field( 'callout_link' );
  $callout_title_size = get_field( 'callout_title_size' );
?>

<section class="block-callout">
  <div class="callout-wrapper">
    <?php 
      if ($callout_image) {
    ?>
      <div class="callout-thumbnail-container">
        <img class="callout-thumbnail" src="<?php echo $callout_image['url']; ?>" alt="<?php echo $callout_image['alt']; ?>" />
      </div>
    <?php
      }
    ?>
    <div class="callout-info callout-info-<?php echo $callout_title_size; ?>">
      <?php
        if ($callout_title) {
      ?>
        <?php
          switch ($callout_title_size) {
            case 'large':
        ?>
            <h2 class="callout-title callout-title-<?php echo $callout_title_size; ?>"><?php echo $callout_title; ?></h2>
        <?php
            break;
            case 'medium':
        ?>
            <h3 class="callout-title callout-title-<?php echo $callout_title_size; ?>"><?php echo $callout_title; ?></h3>
        <?php
            break;
            default:
        ?>
            <h4 class="callout-title callout-title-<?php echo $callout_title_size; ?>"><?php echo $callout_title; ?></h4>
        <?php
            break;
          }
        ?>
      <?php
        }
      ?>
      <?php
        if ($callout_body_text) {
      ?>
        <p class="callout-excerpt"><?php echo $callout_body_text; ?></p>
      <?php
        }
      ?>
      <?php
        if ($callout_link) {
      ?>
        <a class="callout-link btn-link" href="<?php echo $callout_link['url']; ?>" target="<?php echo $callout_link['target']; ?>">
          <h4 class="btn-link-text red"><?php echo $callout_link['title']; ?></h4>
          <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right" />
        </a>
      <?php
        }
      ?>
    </div>
  </div>
</section>