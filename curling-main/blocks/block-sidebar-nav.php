
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
        <p class="sidebar-heading <?php echo $link_link && $link_link['url'] == $current ? 'sidebar-item-current' : ''; ?>">
          <?php
            if ($link_link) {
          ?>
            <a class="sidebar-link clear" href="<?php echo $link_link['url']; ?>" target="<?php echo $link_link['target']; ?>"><?php echo $link_link['title']; ?></a>
          <?php
            }
          ?>
        </p>
        <ul class="sidebar-list">
      <?php
          $link_sublinks = $link['sidebar_sublinks'];
          if ($link_sublinks) {
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
          <li class="sidebar-item <?php echo $sidebar_sublink && $sidebar_sublink['url'] == $current ? 'sidebar-item-current' : ''; ?>"><a class="clear" href="<?php echo $sidebar_sublink ? $sidebar_sublink['url'] : ''; ?>" target="<?php echo $sidebar_sublink ? $sidebar_sublink['target'] : ''; ?>"><?php echo $sidebar_sublink ? $sidebar_sublink['title'] : ''; ?></a></li>
        <?php
            }
          }
        }
      ?>
      </ul>
    </div>
    <?php
      if ($has_current) {
    ?>
      <div class="sidebar-controls-container">
        <?php if ($previous_item) { ?>
          <a class="sidebar-controls sidebar-controls-previous btn" href="<?php echo $previous_item['url']; ?>">Previous</a>
        <?php } else { ?>
          <span class="sidebar-controls sidebar-controls-previous btn disabled">Previous</span>
        <?php } ?>
        <?php if ($next_item) { ?>
          <a class="sidebar-controls sidebar-controls-next btn" <?php echo $next_item ? 'href="'.$next_item['url'].'"' : ''; ?>>Next</a>
        <?php } else { ?>
          <span class="sidebar-controls sidebar-controls-next btn disabled">Next</span>
        <?php } ?>
      </div>
    <?php
      }
    ?>
  </div>
</section>