<?php
/**
 * Block Name: Page Intro
 *
 * This is the template that displays the Page Intro
 */


//$has_cta = get_field('has_cta');
$has_sponsor = get_field('has_sponsor');

$headline = get_field('headline');
$content = get_field('content');

$adsnippet = get_field('adsnippet');
?>

<section class="block-page-intro">
    <div class="page-intro-main">

<?php
//All the Presented By Stuff
if ($has_sponsor) {

    //Sponsor Specific fields
    $sponsor_label = get_field('sponsor_label'); //Sponsor Label
    $sponsor_image = get_field('sponsor_image'); //Sponsor Image
    if (!isset($sponsor_label) || empty($sponsor_label)) {
        $sponsor_label = "Presented By";
    }

    if ( isset($sponsor_image) && !empty($sponsor_image) ) { ?>
<div class='presented-by-box'>
    <h4 class="presented-by-label"><?php echo $sponsor_label; ?></h4>
    <img src="<?php echo $sponsor_image; ?>" class="presented-by-image"/>
</div>
<?php } 
}

//Headline and Paragraph Stuff
echo "<h1 class='page-intro-main-headline'>$headline</h1>";
//echo "<p class='page-intro-main-content'>$content</p>";
echo $content;


/*
//Optional CTA
if ($has_cta) {

    //CTA Specific Fields
    $design = get_field('button_design'); //Callout Title

    $bg_color = "red";
    $color = "white";
    $hover = "white";

    if ($design == "wbb"){
        $bg_color = "white";
        $color = "black";
        $hover = "black";
    } else if ($design == "rbb"){
        $color = "black";
        $hover = "black";
    } else if ($design == "rwb"){
        $color = "white";
        $hover = "black";
    }

    $button_class = "btn styled-button" . " " 
    . "background-{$bg_color}" . " " 
    . "color-{$color}" . " " 
    . "hover-{$hover}";

    $link = get_field('link'); //CTA Link
    $link_label = get_field('link_label'); //Link Label

    //Default to the Link as the label if empty
    if ( !isset($link_label) || empty($link_label) ){
        $link_label = $link;
    }
    echo "<a href='$link' class='$button_class'>$link_label</a>";
}*/
?>
    </div>
    <div class="page-intro-adspace">

<?php

//Ad Area
if (isset($adsnippet) && !empty($adsnippet) ){
    echo $adsnippet;
}

?>
    </div>
</section>

