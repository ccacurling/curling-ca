<?php
/**
 * Block Name: Divider
 *
 * This is the template that displays the divider block.
 */
?>

<?php
  $divider_size = get_field( 'divider_size' );
?>

<section class="block-divider divider-<?php echo $divider_size; ?> content content-full-wrapper">
</section>