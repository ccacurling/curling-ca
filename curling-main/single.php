<?php
/**
 * The template for displaying a single post
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage curling-main
 * @since Twenty Fourteen 1.0
 */
?>

<?php
  $post = get_post();
  $post_thumbnail = get_the_post_thumbnail_url( $post );
  $post_title = $post->post_title;
  $post_content = $post->post_content;
?>

<?php
  get_header();
?>
<section class="block-hero block-hero-large js-hero-container">
  <div class="hero-media-container">
    <img class="hero-background-image" src="<?php echo $post_thumbnail; ?>" alt="Background">
  </div>
      <div class="block-hero-inner left js-hero-content">
            <div class="hero-title-container hero-no-post-type">
                  <h2 class="hero-title"><?php echo $post_title; ?></h2>
              </div>
            <div class="hero-body-container">
        <p class="hero-body"></p>
      </div>
          </div>
    </section>

<div class="content content-fixed">
  <?php echo $post_content; ?>
</div>
<?php
  get_footer();
?>