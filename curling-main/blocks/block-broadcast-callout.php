<?php
/**
 * Block Name: Callout
 *
 * This is the template that displays the callout block.
 */

$callout_label = get_field( 'callout_label' );
$callout_image = get_field( 'callout_image' );
$callout_title = get_field( 'callout_title' );
$callout_body_text = get_field( 'callout_body_text' );
$callout_link = get_field( 'callout_link' );
$callout_pdf_schedule_link_text = get_field( 'callout_pdf_schedule_link_text' );
$callout_pdf_schedule_link = get_field( 'callout_pdf_schedule_link' );
?>

<section role="callout-block" class="block-callout block-broadcast-callout">
  <div class="callout-wrapper">
    <?php
      if ($callout_label) {
    ?>
      <div role="label" class="callout-label">
        <h4 class="inverted"><?php echo $callout_label; ?></h4>
      </div>
    <?php
      }
    ?>
    <?php 
      if ($callout_image) {
    ?>
      <div role="thumbnail" class="callout-thumbnail-container">
        <img class="callout-thumbnail" src="<?php echo $callout_image['url']; ?>" alt="<?php echo $callout_image['alt']; ?>" />
      </div>
    <?php
      }
    ?>
    <div role="info" class="callout-info">
      <?php
        if ($callout_title) {
      ?>
        <h3 class="callout-title inverted"><?php echo $callout_title; ?></h3>
      <?php
        }
      ?>
      <?php
        if ($callout_body_text) {
      ?>
        <p class="callout-excerpt inverted"><?php echo $callout_body_text; ?></p>
      <?php
        }
      ?>
      <?php
        if ($callout_link) {
      ?>
        <div>
          <a class="broadcast-callout-btn btn btn-red" href="<?php echo $callout_link['url']; ?>" target="<?php echo $callout_link['target']; ?>">
            <h3 class="broadcast-callout-btn-text"><?php echo $callout_link['title']; ?></h3>
          </a>
        </div>
      <?php
        }
      ?>
      <?php
        if ($callout_pdf_schedule_link_text && $callout_pdf_schedule_link) {
      ?>
        <a class="broadcast-callout-link inverted" href="<?php echo $callout_pdf_schedule_link['url']; ?>" ><p class="inverted"><?php echo $callout_pdf_schedule_link_text; ?></p></a>
      <?php
        }
      ?>
    </div>
  </div>
</section>