<?php
/**
 * Block Name: Event Callout
 *
 * This is the template that displays a single Event Callout
 */
$link = get_field('link'); //Event Link
$logo = get_field('logo'); //Event Logo
$title = get_field('title'); //Event Title
$description = get_field('description'); //Event description text
$date = get_field('date'); //Event date
$location = get_field('location'); //Event location
$tickets = get_field('tickets'); //Event Tickets Link
$ticket_text = get_field('ticket_text'); //Event Tickets Link

if ($ticket_text == ""){
	$ticket_text = "tickets";
}
?>
<div class="wp-block-media-text alignwide">
	<figure class="wp-block-media-text__media">
		<a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $logo; ?>" style="max-width:275px"></a>
	</figure>
	<div class="wp-block-media-text__content">
		<h4><?php echo $title; ?></h4>
		<p>
			<em><?php echo $description; ?></em><br/>
			<strong><?php echo $date; ?><br/>
			<?php echo $location; ?></strong>
		</p>
		<?php if ($tickets){ ?>
		<a href="<?php echo $tickets; ?>" class="btn styled-button background-red color-white hover-white text-small" style="margin-top: 10px;"><?php echo $ticket_text; ?></a>
		<?php } ?>
	</div>
</div>