<?php
/**
 * Block Name: Text Callouts
 *
 * This is the template that displays a row of Three Text Callouts - Used in Events About and Events Fanzone
 */

$callouts = array(); 
$callouts[] = get_field('first_callout');
$callouts[] = get_field('second_callout');
$callouts[] = get_field('third_callout');

?>
<section class="text-callouts-group">
<?php

foreach ($callouts as $callout){

  $has_image = false;
  
  //Default to the Link as the label if empty
  if ( !isset($callout['link_label']) || empty($callout['link_label']) ){
    $callout['link_label'] = $callout['link'];
  }
  
  if (isset($callout['image']) && !empty($callout['image']) ){ 
    $has_image = true;
  }


  ?>
  <div class='single-text-callout<?php echo ($has_image ? ' has-image' : ''); ?>'>
  <?php 
  if ($has_image){ 
    echo "<img src='{$callout['image']}'/>";
  } 
  ?>
    <div class='callout-details<?php echo ($has_image ? ' has-image' : ''); ?>'>
      <h4><?php echo $callout['title']; ?></h4>
  <?php
  if (isset($callout['description']) && !empty($callout['description']) ){ 
    echo "<p>{$callout['description']}</p>";
  }
  ?> 
      <a href="<?php echo $callout['link']; ?>"><?php echo $callout['link_label']; ?></a>
    </div>
  </div>
  <?php
}
?>
</section>
