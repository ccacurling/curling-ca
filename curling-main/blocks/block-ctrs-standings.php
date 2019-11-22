<?php
  /**
   * Block Name: CTRS Standings
   *
   * This is the template that displays CTRS Standings both Male/Female
   */


  
  function ccm_get_mens_standing() {
    $eventyear2 = 2020;
	  $eventtypeid2 = 81;
	  
	  $filename2 = "http://ctrs.curling.ca/eventtype" . $eventtypeid2 . "_year" . $eventyear2 . ".xml";
	  $ste2 = simplexml_load_file($filename2);
	  
    return $ste2->team;
  }

  function ccm_get_womens_standing(){
    $eventyear1 = 2020;
    $eventtypeid1 = 82;
    
    $filename1="http://ctrs.curling.ca/eventtype" . $eventtypeid1 . "_year" . $eventyear1 . ".xml";
    $ste1 = simplexml_load_file($filename1);
    
    return $ste1->team;
  }

  $full_menu = get_field('full_menu');

  $mens_standing = ccm_get_mens_standing();
  $womens_standing = ccm_get_womens_standing();

  $mens_full_link = get_field('mens_full_link');
  $womens_full_link = get_field('womens_full_link');
  

  $number_to_show = get_field('number_to_show');
  if ( !isset($number_to_show) || empty($number_to_show) ){
    $number_to_show = 5;
  }

  if ($full_menu) {
    //Get the full standings
    $doubles_rankings = get_field("doubles_ranking");
    $doubles_full_link = get_field('doubles_full_link');
    
    $macup = get_field("ma_cup_ranking");
    if ( !is_array($macup) ) {
      $macup = array();
    }

    $macup_full_link = get_field('ma_cup_full_link');

  }

?>

<section class="ctrs-container">
  
  <div class="ctrs-title-wrapper">
  <?php if ($full_menu) { ?>
    <div class='ctrs-menu-container'>
      <span class='ctrs-menu ctrs-menu-standings selected'><?php echo __("CTRS Standings"); ?></span>
      <span class='ctrs-menu ctrs-menu-doubles'><?php echo __("Mixed Doubles Ranking"); ?></span>
      <span class='ctrs-menu ctrs-menu-cup'><?php echo __("The MA Cup: Top 5"); ?></span>
    </div>
  <?php } ?>
    <h3 class="ctrs-main-title"><?php echo __("Canada Team Ranking System (CTRS)"); ?></h3>

    <!-- CTRS Standings -->
    <div class="ctrs-wrapper ctrs-standings">

      <div class="ctrs-standings-list womens-list">
        <h3><?php echo __("CTRS Standings Womens"); ?></h3>
        <div class="standings-container">

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
        <a href="<?php echo $womens_full_link; ?>" class="standings-link"><?php echo __("View Full Standings");?><img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("arrow-right"); ?>" /></a>
      <?php } ?>
      </div>

    
      <div class="ctrs-standings-list mens-list">
        <h3><?php echo __("CTRS Standings Mens"); ?></h3>
        <div class="standings-container">
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
        <a href="<?php echo $mens_full_link; ?>" class="standings-link"><?php echo __("View Full Standings");?><img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("arrow-right"); ?>" /></a>
      <?php } ?>
      </div>

    

    </div>
    <!-- End of Standings -->


    <!-- CTRS Doubles -->
    <div class="ctrs-wrapper ctrs-doubles hide">

      <div class="ctrs-standings-list">
        <h3><?php echo __("Mixed Doubles Rankings"); ?></h3>
        <div class="standings-container">

      <?php
        $counter = 0;
        foreach ($doubles_rankings as $team) {
          $counter++;

          $row_class = "ctrs-odd-row";
          if ($counter % 2 == 0){
            $row_class = "ctrs-even-row";
          }

          echo "<p class='{$row_class}'><span class='rank'>{$counter}</span><span class='name'>{$team['team']}</span><span class='score'>{$team['points']}</span></p>";
        }
      ?>
        </div>
      <?php if ( isset($doubles_full_link) && !empty($doubles_full_link) ) { ?>
        <a href="<?php echo $doubles_full_link; ?>" class="standings-link"><?php echo __("View Full Standings");?><img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("arrow-right"); ?>" /></a>
      <?php } ?>
      </div>
    </div>
    <!-- End of Doubles -->


    <!-- CTRS MA Cup -->
    <div class="ctrs-wrapper ctrs-cup hide">

      <div class="ctrs-standings-list">
        <h3><?php echo __("MA Cup: Top 5"); ?></h3>
        <div class="standings-container">

      <?php
        $counter = 0;
        foreach ($macup as $team) {
          $counter++;

          $row_class = "ctrs-odd-row";
          if ($counter % 2 == 0){
            $row_class = "ctrs-even-row";
          }

          echo "<p class='{$row_class}'><span class='rank'>{$counter}</span><span class='score'>{$team['points']}</span> <img class='flag' src='{$team['flag']}'/> <span class='name'>{$team['team']}</span> </p>";
        }
      ?>
        </div>
      <?php if ( isset($macup_full_link) && !empty($macup_full_link) ) { ?>
        <a href="<?php echo $macup_full_link; ?>" class="standings-link"><?php echo __("Learn More");?><img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("arrow-right"); ?>" /></a>
      <?php } ?>
      </div>
    </div>
    <!-- End of MA Cup -->


  </div>
</section>
