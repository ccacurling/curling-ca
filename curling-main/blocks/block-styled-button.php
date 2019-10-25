<?php
/**
 * Block Name: Styled Button
 *
 * This is the template that displays a single Curling Styled Button
 */
$design = get_field('button_design'); //Callout Title
$text_size = get_field('text_size');
$target_blank = get_field( 'target_blank' );

$bg_color = "red";
$color = "white";
$hover = "white";
$outline = "";
$align = $block['align'];

if ($design == "wbb"){
  $bg_color = "white";
  $color = "black";
  $hover = "black";
} else if ($design == "rbb"){
  $color = "black";
  $hover = "black";
} else if ($design == "rwb"){
  $color = "white";
  $hover = "black";
} else if ($design == "rorb") {
  $bg_color = "white";
  $color = "red";
  $hover = "black";
  $outline = "red";
}

$button_class = "btn styled-button" . " " 
  . "background-{$bg_color}" . " " 
  . "color-{$color}" . " " 
  . "hover-{$hover}" . ($outline ? " outline-".$outline : "");

$link = get_field('link'); //CTA Link
$link_label = get_field('label'); //Link Label


//Default to the Link as the label if empty
if ( !isset($link_label) || empty($link_label) ){
  $link_label = $link;
}
?>
<div class="<?php echo $align; ?>">
  <a class="<?php echo $button_class; ?> text-<?php echo $text_size; ?>"  href="<?php echo $link; ?>" target="<?php echo $target_blank ? '_blank' : '_self'; ?>">
    <?php echo $link_label; ?>
  </a>
</div>
