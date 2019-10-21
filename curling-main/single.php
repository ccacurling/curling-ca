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
  $show_social_share_buttons = get_field('show_social_share_buttons');
?>

<?php
  get_header();
?>
<div class="content-post content content-full-wrapper content-anchor">
<div class="block-column column-16-84 column-fullwidth">
  <div class="wp-block-cossette-block-column-2">
    <div class="post-content wp-block-columns has-2-columns">
      <div class="wp-block-column">
        <?php
          if (is_null($show_social_share_buttons) || $show_social_share_buttons) {
        ?>
          <div class="content-social-share">
            <h4 class="social-share-heading gray">Share</h4>
            <div class="social-share-container">
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
                <img class="social-share social-share-facebook" src="<?php echo get_stylesheet_directory_uri()."/images/icon-facebook-gray.svg"; ?>" alt="Facebook" />
            </a>
            </div>
            <div class="social-share-container">
              <a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>" target="_blank">
                <img class="social-share social-share-twitter" src="<?php echo get_stylesheet_directory_uri()."/images/icon-twitter-gray.svg"; ?>" alt="Twitter" />
              </a>
            </div>
          </div>
        <?php
          }
        ?>
      </div>
      <div class="wp-block-column content-small-wrapper content">
        <?php 
        if (have_posts()) : 
          while (have_posts()) : 
            the_post();
        ?>
          <h1 class="curling-post-title"><?php the_title(); ?></h1>
        <?php
              the_content();
            endwhile;
          endif; 
        ?>
      </div>
    </div>
  </div>
</div>
<?php
  get_footer();
?>