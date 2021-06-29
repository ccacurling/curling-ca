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

<section role="divider" class="block-divider divider-<?php echo $divider_size; ?> content-full-wrapper">
</section>