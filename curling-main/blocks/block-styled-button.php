<?php
/**
 * Block Name: Styled Button
 *
 * This is the template that displays a single Curling Styled Button
 */
$design = get_field('button_design'); //Callout Title

$bg_color = "red";
$color = "white";
$hover = "white";

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
}

$button_class = "btn styled-button" . " " 
  . "background-{$bg_color}" . " " 
  . "color-{$color}" . " " 
  . "hover-{$hover}";

$link = get_field('link'); //CTA Link
$link_label = get_field('label'); //Link Label


//Default to the Link as the label if empty
if ( !isset($link_label) || empty($link_label) ){
  $link_label = $link;
}
?>
<a href="<?php echo $link; ?>" class="<?php echo $button_class; ?>"><?php echo $link_label; ?></a>
