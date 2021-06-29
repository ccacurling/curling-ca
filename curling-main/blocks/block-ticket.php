<?php
/**
 * Block Name: Ticket
 *
 * This is the template that displays the ticket block.
 */

$ticket_colour = get_field( 'ticket_colour' );
$ticket_title = get_field( 'ticket_title' );
$ticket_price = get_field( 'ticket_price' );
$ticket_price_info = get_field( 'ticket_price_info' );
$ticket_options = get_field( 'ticket_options' );
$ticket_legal = get_field( 'ticket_legal' );
$ticket_link = get_field( 'ticket_link' );

$ticket_price_split = explode('.', $ticket_price);
$ticket_price_colour = $ticket_colour === 'white' ? 'red' : ($ticket_colour === 'gray' ? 'inverted' : '');
$ticket_primary_colour = $ticket_colour === 'white' ? '' : ($ticket_colour === 'gray' ? 'inverted' : '');
$ticket_secondary_colour = $ticket_colour === 'white' ? 'red' : ($ticket_colour === 'gray' ? 'inverted' : '');
?>

<section role="ticket-info" class="block-ticket block-ticket-<?php echo $ticket_colour; ?>">
  <div role="ticket-header" class="ticket-header">
  <?php if (!empty($ticket_primary_colour)): ?>
    <h2 class="ticket-title <?php echo $ticket_primary_colour; ?>"><?php echo $ticket_title; ?></h2>
  </div>
  <h4 class="ticket-price-title <?php echo $ticket_primary_colour; ?>"><?php echo __("From:"); ?></h4>
  <?php endif; ?>
  <div role="price" class="ticket-price-container">
  <?php if (!empty($ticket_price_colour)): ?>
    <div class="ticket-price-wrapper">
      <h2 class="ticket-price-dollar-symbol <?php echo $ticket_price_colour; ?>"><?php echo __("$"); ?></h2>
      <h1 class="ticket-price-dollar text-highlight <?php echo $ticket_price_colour; ?>"><?php echo $ticket_price_split[0]; ?></h1>
      <h2 class="ticket-price-cents <?php echo $ticket_price_colour; ?>">.<?php echo $ticket_price_split[1]; ?></h2>
  </div>
  <h4 class="ticket-price-info <?php echo $ticket_price_colour; ?>"><?php echo $ticket_price_info; ?></h4>
  </div>
  <?php endif; ?>
  <div role="options" class="ticket-options-wrapper">
    <div class="ticket-option-title-wrapper">
    <?php if (!empty($ticket_primary_colour)): ?>
      <h4 class="ticket-option-title <?php echo $ticket_primary_colour; ?>"><?php echo __("Options:"); ?></h4>
    <?php endif; ?>
    </div>  
    <?php
      if ($ticket_options) {
        foreach ($ticket_options as $key => $ticket_option) {
          $option_price = $ticket_option['option_price'];
          $option_description = $ticket_option['option_description'];
    ?>
        <div class="ticket-option-price-container">
          <h3 class="ticket-option-price <?php echo $ticket_secondary_colour; ?>">$<?php echo $option_price; ?></h3>
          <p class="<?php echo $ticket_primary_colour; ?>"><?php echo $option_description; ?></p>
        </div>
    <?php
        }
      }
    ?>
  </div>
  <div class="ticket-wrapper">
    <div class="ticket-button-container btn btn-red">
      <span class="ticket-button-text inverted">
        <a class="clear" href="<?php echo $ticket_link['url']; ?>" target="<?php echo $ticket_link['target']; ?>">
          <?php echo $ticket_link['title']; ?>
        </a>
      </span>
    </div>
  </div>
  <div class="ticket-legal-wrapper">
    <p class="ticket-legal <?php echo $ticket_primary_colour; ?>"><?php echo $ticket_legal; ?></p>
  </div>
</section>