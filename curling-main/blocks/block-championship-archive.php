<?php
/**
 * Block Name: News Feed
 *
 * This is the template that displays the News Feed block.
 */
?>

<?php
  $championship_archives = get_field( 'championship_events', 'Options');
  $id = rand(10000000, 99999999);
?>

<section role="championship-block" class="block-championship-archive"> 
  <?php
    if ($championship_archives) {
      foreach ($championship_archives as $key => $championship_archive) {
  ?>
    <h3 class="championship-name"><?php echo $championship_archive['championship_name']; ?></h3>
      <?php
        if ($championship_archive['championship_events']) {
      ?>
        <div role="event" class="championship-event-wrapper">
        <?php
          foreach ($championship_archive['championship_events'] as $key => $championship_event) {
        ?>
        <div class="championship-event-container js-accordion" data-id="<?php echo $id; ?>">
          <div class="championship-event-title-container js-accordion-trigger" data-id="<?php echo $id; ?>">
            <h4 class="championship-event-name gray"><?php echo $championship_event['championship_event_name']; ?></h4>
            <p class="championship-event-trigger js-accordion-trigger-text" data-trigger-show="<?php echo __("Show All"); ?>" data-trigger-hide="<?php echo __("Hide All"); ?>" data-id="<?php echo $id; ?>"><?php echo __("Show All"); ?></p>
            <img class="championship-event-trigger-mobile " src="<?php echo get_stylesheet_directory_uri(); ?>/images/triangle-down-gray.svg" alt="<?php echo __("Triangle"); ?>" />
          </div>
          <div role="events-list" class="championship-events-list-container js-accordion-content" data-id="<?php echo $id; ?>">
            <?php
              if ($championship_event['championship_events']) {
            ?>
                <?php
                  foreach ($championship_event['championship_events'] as $key => $championship_match) {
                    ?>
                    <div class="championship-events-container">
                    <h4 class="championship-match-name"><?php echo $championship_match['match_name']; ?></h4>
                    <?php
                      if ($championship_match['match_links']) {
                    ?>
                      <div class="championship-match-links-container">
                        <?php
                          $i = 0;
                          $count = count($championship_match['match_links']);
                          foreach ($championship_match['match_links'] as $key => $match_link) {
                        ?>
                          <a class="championship-match-link" href="<?php echo $match_link['match_link']['url']; ?>" target="<?php echo $match_link['match_link']['target']; ?>"><?php echo $match_link['match_link']['title']; ?></a><?php echo $i < $count - 1 ? '<p>&nbsp;|&nbsp;</p>' : ''; ?>
                        <?php
                            $i++;
                          }
                        ?>
                      </div>
                    <?php
                      }
                    ?>
                  </div>
                <?php
                  }
                ?>
            <?php
              }
            ?>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
    <?php
      }
    ?>
  <?php
      }
    }
  ?>
</section>