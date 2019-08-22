
<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */

$image = get_field( 'image' );

?>
<div class="hero content-fixed">
	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
</div>
