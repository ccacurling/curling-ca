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
<div class="content content-full-wrapper">
  <div class="curling-post content-wrapper content-padding">
    <div class="curling-sidebar content-sidebar-container">
      <?php get_sidebar( 'posts' ); ?>
    </div>
    <div class="curling-content content-main-container">
      <?php 
        if (have_posts()) : 
          while (have_posts()) : 
            the_post();
      ?>
        <h2 class="curling-post-title"><?php the_title(); ?></h2>
      <?php
            the_content();
          endwhile;
        endif; 
      ?>
    </div>
  </div>
</div>
<?php
  get_footer();
?>