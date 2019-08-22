<?php
/**
 * The template for displaying the footer
 * @package curling
 */

?>

<?php echo !WP_DEBUG ?: "<!-- Begin output from ".basename(__FILE__)."-->"; ?>
<footer id="footer" class="site-footer">
    <?php get_template_part('template-parts/content', 'footer'); ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
<?php echo !WP_DEBUG ?: "<!-- End output from ".basename(__FILE__)." -->" ?>