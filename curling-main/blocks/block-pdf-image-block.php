<?php
/**
 * Block Name: PDF w/ Image
 *
 * This is the template that displays the PDF with Image block
 */

  $id = 'pdf-image-block-' . $block['id'];
?>

<section id="<?php echo $id ?>" class="pdf-with-image-block-container">

  <div class="pdf-section">

    <?php if ( have_rows('pdfs') ) {
      while ( the_repeater_field( 'pdfs' ) ) {
        $img   = get_sub_field( 'image' );
        $title = get_sub_field( 'title' );
        $pdf   = get_sub_field( 'pdf' ); ?>

        <div class="pdf-container">

          <?php if ($img) { ?>
            <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>" />
          <?php }?>

          <?php if ($title) { ?>
            <p><?php echo $title ?></p>
          <?php } ?>
          
          <?php if ($pdf) { ?>
            <a href="<?php echo $pdf ?>" target="_blank"><button class="btn">Download PDF</button></a>
          <?php } ?>

        </div>
        
      <?php } ?>
    <?php } else { ?>

      <h2>No PDF's selected</h2>

    <?php } ?>
  </div>
  
</section>
