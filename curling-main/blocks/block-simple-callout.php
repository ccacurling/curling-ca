<?php
/**
 * Block Name: Simple Callout
 *
 * This is the template that displays a simple callout block
 */
$title = get_field('simple_callout_title'); //Callout Title
$description = get_field('simple_callout_description'); //Callout Description text

$link = get_field('simple_callout_link'); //CTA Link

//Default to the Link as the label if empty
if ( !isset($link_label) || empty($link_label) ){
  $link_label = $link;
}
?>

<section class="block-simple-callout">
  <div class="simple-callout-mobile">
    <a class="simple-callout-link-mobile" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><h4 class="simple-callout-title-mobile arrow-right-large-gray gray"><?php echo $title; ?></h4></a>
  </div>
  <div class="simple-callout-desktop">
  <h2 class="simple-callout-title"><?php echo $title; ?></h2>
  <p class="simple-callout-description"><?php echo $description; ?></p>
  <?php 
    if ( isset($link) ) { 
  ?>
    <div class="simple-callout-container">
      <a class="simple-callout-link btn btn-red" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link_label['title']; ?></a>
    </div>
  <?php 
    } 
  ?>
</section>