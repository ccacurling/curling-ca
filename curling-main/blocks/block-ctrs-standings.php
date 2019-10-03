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
  <h3><?php echo __("Canada Team Ranking System (CTRS)"); ?></h3>
  <div class="ctrs-wrapper">


    <div class="ctrs-standings-list womens-list">
      <h3><?php __("CTRS Standinds Womens"); ?></h3>

      <?php
        $counter = 0;
        foreach ($womens_standing as $team) {
          $counter++;

          $row_class = "ctrs-odd-row";
          if ($counter % 2 == 0){
            $row_class = "ctrs-even-row";
          }

          echo "<p class='{$row_class}'><span>{$team->skipfirstname} {$team->skiplastname}</span><span>{$team->points}</span></p>";
          if ($counter == $number_to_show){
            break;
          }

        }
      ?>
      
      <?php if ( isset($womens_full_link) && !empty($womens_full_link) ) { ?>
        <a href="<?php echo $womens_full_link; ?>" class="standings-link"><?php echo __("View Full Standings");?></a>
      <?php } ?>
    </div>

    
    <div class="ctrs-standings-list mens-list">
      <h3><?php __("CTRS Standinds Mens"); ?></h3>

      <?php
        $counter = 0;
        foreach ($mens_standing as $team) {
          $counter++;

          $row_class = "ctrs-odd-row";
          if ($counter % 2 == 0){
            $row_class = "ctrs-even-row";
          }

          echo "<p class='{$row_class}'><span>{$team->skipfirstname} {$team->skiplastname}</span><span>{$team->points}</span></p>";
          if ($counter == $number_to_show){
            break;
          }
        }
      ?>

      <?php if ( isset($mens_full_link) && !empty($mens_full_link) ) { ?>
        <a href="<?php echo $mens_full_link; ?>" class="standings-link"><?php echo __("View Full Standings");?></a>
      <?php } ?>
    </div>

    

  </div>

  
</section>
