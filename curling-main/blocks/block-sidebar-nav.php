
<?php
/**
 * Block Name: Sidebar Navigation
 *
 * This is the template that displays the Sidebar Navigation block.
 */
?>

<?php
  $links = get_field( 'sidebar_links' );
  $current = get_permalink();
  $has_current = false;
  $previous_item = null;
  $next_item = null;
?>

<section class="curling-sidebar">
  <div class="sidebar-container">
    <div class="sidebar-nav-container">
      <?php
        foreach ($links as $key => $link) {
          $link_link = $link['sidebar_link'];
          if ($has_current && !$next_item) {
            $next_item = $link_link;
          }
          if ($link_link && $link_link['url'] == $current) {
            $has_current = true;
          }
          if (!$has_current) {
            $previous_item = $link_link;
          }
      ?>
        <p class="sidebar-heading"><?php echo $link_link['title']; ?></p>
        <ul class="sidebar-list">
      <?php
          $link_sublinks = $link['sidebar_sublinks'];
          foreach ($link_sublinks as $key => $sublink) {
            $sidebar_sublink = $sublink['sidebar_sublink'];
            if ($has_current && !$next_item) {
              $next_item = $sidebar_sublink;
            }
            if ($sidebar_sublink && $sidebar_sublink['url'] == $current) {
              $has_current = true;
            }
            if (!$has_current) {
              $previous_item = $sidebar_sublink;
            }
      ?>
        <li class="sidebar-item <?php echo $sidebar_sublink && $sidebar_sublink['url'] == $current ? 'sidebar-item-current' : ''; ?>"><?php echo $sidebar_sublink ? $sidebar_sublink['title'] : ''; ?></li>
      <?php
          }
        }
      ?>
      </ul>
    </div>
    <?php
      if ($has_current) {
    ?>
      <div class="sidebar-controls-container">
        <a class="sidebar-controls sidebar-controls-previous btn <?php echo !$previous_item ? 'disabled' : ''; ?>" href="<?php echo $previous_item ? $previous_item['url'] : ''; ?>">Previous</a>
        <a class="sidebar-controls sidebar-controls-next btn <?php echo !$next_item ? 'disabled' : ''; ?>" <?php echo $next_item ? 'href="'.$next_item['url'].'"' : ''; ?>>Next</a>
      </div>
    <?php
      }
    ?>
  </div>
</section>