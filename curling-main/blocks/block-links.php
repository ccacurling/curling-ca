<?php
/**
 * Block Name: Links
 *
 * This is the template that displays the links block.
 */

 $links = get_field( 'links' );

 ?>

 <section class="block-links">
  <div class="block-links-container">
    <div class="block-links-wrapper">
      <?php
        foreach ($links as $key => $link) {
      ?>
        <a class="link-item-container clear" href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>"><p class="link-item"><?php echo $link['link']['title']; ?></p></a>
      <?php
        }
      ?>
    </div>
  </div>
</section>