<?php
  /**
   * Block Name: CTRS Standings
   *
   * This is the template that displays CTRS Standings both Male/Female
   */


  
  function ccm_get_mens_standing() {
    $eventyear2 = 2019;
	  $eventtypeid2 = 81;
	  
	  $filename2 = "http://ctrs.curling.ca/eventtype" . $eventtypeid2 . "_year" . $eventyear2 . ".xml";
	  $ste2 = simplexml_load_file($filename2);
	  
    return $ste2->team;
  }

  function ccm_get_womens_standing(){
    $eventyear1 = 2019;
    $eventtypeid1 = 82;
    
    $filename1="http://ctrs.curling.ca/eventtype" . $eventtypeid1 . "_year" . $eventyear1 . ".xml";
    $ste1 = simplexml_load_file($filename1);
    
    return $ste1->team;
  }

  $mens_standing = ccm_get_mens_standing();
  $womens_standing = ccm_get_womens_standing();

  $mens_full_link = get_field('mens_full_link');
  $womens_full_link = get_field('womens_full_link');

  $number_to_show = get_field('number_to_show');
  if ( !isset($number_to_show) || empty($number_to_show) ){
    $number_to_show = 5;
  }

?>

<section class="ctrs-container">
  
  <div class="ctrs-title-wrapper">
    <h3><?php echo __("Canada Team Ranking System (CTRS)"); ?></h3>
    <div class="ctrs-wrapper">

      <div class="ctrs-standings-list womens-list">
        <h3><?php echo __("CTRS Standings Womens"); ?></h3>
        <div class="stadings-container">

      <?php
        $counter = 0;
        foreach ($womens_standing as $team) {
          $counter++;

          $row_class = "ctrs-odd-row";
          if ($counter % 2 == 0){
            $row_class = "ctrs-even-row";
          }

          echo "<p class='{$row_class}'><span class='name'>{$team->skipfirstname} {$team->skiplastname}</span><span class='score'>{$team->points}</span></p>";
          if ($counter == $number_to_show){
            break;
          }

        }
      ?>
        </div>
      <?php if ( isset($womens_full_link) && !empty($womens_full_link) ) { ?>
        <a href="<?php echo $womens_full_link; ?>" class="standings-link"><?php echo __("View Full Standings");?><img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right" /></a>
      <?php } ?>
      </div>

    
      <div class="ctrs-standings-list mens-list">
        <h3><?php echo __("CTRS Standings Mens"); ?></h3>
        <div class="stadings-container">
      <?php
        $counter = 0;
        foreach ($mens_standing as $team) {
          $counter++;

          $row_class = "ctrs-odd-row";
          if ($counter % 2 == 0){
            $row_class = "ctrs-even-row";
          }

          echo "<p class='{$row_class}'><span class='name'>{$team->skipfirstname} {$team->skiplastname}</span><span class='score'>{$team->points}</span></p>";
          if ($counter == $number_to_show){
            break;
          }
        }
      ?>
        </div>
      <?php if ( isset($mens_full_link) && !empty($mens_full_link) ) { ?>
        <a href="<?php echo $mens_full_link; ?>" class="standings-link"><?php echo __("View Full Standings");?><img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right" /></a>
      <?php } ?>
      </div>

    

    </div>
  </div>
</section>
