<?php
/**
 * Block Name: Presented By
 *
 * This is the template that displays a single Sponsor Image with a Presented by label
 */
$label = get_field('label'); //Sponsor Label
$image = get_field('image'); //Sponsor Image

if (!isset($label) || empty($label)) {
    $label = "Presented By";
}

if ( isset($image) && !empty($image) ) { ?>
<div class='presented-by-box'>
    <h4 class="presented-by-label"><?php echo $label; ?></h4>
    <img src="<?php echo $image; ?>" class="presented-by-image"/>
</div>
<?php } ?>

