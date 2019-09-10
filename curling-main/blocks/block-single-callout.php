<?php
/**
 * Block Name: Single Callout
 *
 * This is the template that displays a single callout block
 */
$title = get_field('title'); //Callout Title
$description = get_field('description'); //Callout Description text

$link = get_field('link'); //CTA Link
$link_label = get_field('link_label'); //Link Label

//Default to the Link as the label if empty
if ( !isset($link_label) || empty($link_label) ){
  $link_label = $link;
}
?>

<section class="block-single-callout block-single-callout-red<?php //echo $background_colour; ?>">
  <div class='callout-inner'>
    <div class="callout-left">
      <h3><?php echo $title; ?></h3>
      <p><?php echo $description; ?></p>
    </div>
<?php if ( isset($link) && !empty($link) ) { ?>
    <div class="callout-right">
      <a href="<?php echo $link; ?>" class="callout-link"><?php echo $link_label; ?></a>
    </div>
<?php } ?>
  </div>
</section>