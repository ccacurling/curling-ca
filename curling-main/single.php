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
get_header();
?>
<div class="content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
    endwhile; else: ?>
    <p>Sorry, no posts matched your criteria.</p>
    <?php endif; ?>
</div>
<?php
get_footer();
?>