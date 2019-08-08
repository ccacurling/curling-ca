<?php
/**
 * The template for displaying the footer
 * @package curling
 */

?>

<?php
    $menu_locations = get_nav_menu_locations();
    $top_left_menu_items = wp_get_nav_menu_items( 'Footer Nav' );
    $primary_menu_items = wp_get_nav_menu_items( 'Footer Legal' );
?>

<?php echo !WP_DEBUG ?: "<!-- Begin output from ".basename(__FILE__)."-->"; ?>
<footer id="footer" class="site-footer">
    <div class="footer-nav footer-nav-red">
        <div class="footer-nav-wrapper content-fixed">
            <div class="footer-nav-left">
                <img class="footer-logo" src="<?php echo get_stylesheet_directory_uri()."/images/logo-full.svg"; ?>" alt="Site Logo" />
                <?php
                    if ($top_left_menu_items) {
                ?>
                    <ul class="footer-nav-left-items menu-nav">
                        <?php
                            foreach( $top_left_menu_items as $menu_item ) {
                        ?>
                            <li class="menu-item"><h4 class="inverted"><?php echo $menu_item->title; ?></h4></li>
                        <?php
                            }
                        ?>
                    </ul>
                <?php
                    }
                ?>
            </div>
            <div class="footer-nav-right">
            </div>
        </div>
    </div>
    <div class="footer-nav-legal footer-nav-legal-red">
        <div class="footer-nav-legal-wrapper content-fixed">
            <?php
                if ($primary_menu_items) {
            ?>
                <ul class="menu-nav">
                    <?php
                        foreach( $primary_menu_items as $menu_item ) {
                    ?>
                        <li class="menu-item"><h4 class="inverted"><?php echo $menu_item->title; ?></h4></li>
                    <?php
                        }
                    ?>
                </ul>
            <?php
                }
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
<?php echo !WP_DEBUG ?: "<!-- End output from ".basename(__FILE__)." -->" ?>