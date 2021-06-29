<?php
/**
 * Block Name: Download Item Callout
 *
 * This is the template that displays a download item callout block
 */

$title = get_field('download_item_callout_title');
$button_title = get_field('download_item_callout_button_title');
$file = get_field('download_item_callout_file');
?>

<section role="download" class="block-download-item-callout">
  <div class='download-item-inner'>
    <div class="download-item-left">
      <h3 class="download-item-title"><?php echo $title; ?></h3>
    </div>
      <?php 
        if ($file) { 
      ?>
        <div class="download-item-right">
          <a href="<?php echo $file['url']; ?>" target="_blank" class="download-item-btn btn btn-red btn-large"><?php echo $button_title; ?></a>
        </div>
      <?php
        } 
      ?>
  </div>
</section>