<?php
/**
 * The template for displaying the footer
 * @package curling
 */

?>

<?php
    $top_left_menu_items = wp_get_nav_menu_items( 'Menu - Footer' );
    $primary_menu_items = wp_get_nav_menu_items( 'Menu - Legal' );
?>

<?php echo !WP_DEBUG ?: "<!-- Begin output from ".basename(__FILE__)."-->"; ?>
<footer id="footer" class="site-footer">
    <div class="footer-nav footer-nav-red">
        <div class="footer-nav-wrapper content-fixed content-fixed-padding">
            <img class="footer-logo" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main-white.svg"; ?>" alt="Site Logo" />
            <div class="footer-nav-left">
                <?php
                    if ($top_left_menu_items) {
                ?>
                    <div class="footer-nav-left">
                        <ul class="footer-nav-left-items menu-nav">
                            <?php
                                foreach( $top_left_menu_items as $menu_item ) {
                            ?>
                                <li class="menu-item"><h4 class="inverted"><?php echo $menu_item->title; ?></h4></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="footer-nav-right">
                <h4 class="inverted">Sign up for the Newsletter</h4>
                <form id="newsletter-signup" class="footer-form">
                    <input class="newsletter-signup-input" type="text" />
                    <button class="newsletter-signup-submit btn btn-small btn-red" type="submit">Submit</button>
                </form>
                <div class="footer-nav-social">
                    <img class="footer-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-facebook.svg"; ?>" alt="social" />
                    <img class="footer-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-twitter.svg"; ?>" alt="social" />
                    <img class="footer-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-instagram.svg"; ?>" alt="social" />
                    <img class="footer-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-youtube.svg"; ?>" alt="social" />
                    <img class="footer-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-linkedin.svg"; ?>" alt="social" />
                </div>
            </div>
        </div>
    </div>
    <div class="footer-nav-legal footer-nav-legal-red">
        <div class="footer-nav-legal-wrapper content-fixed content-fixed-padding">
            <div class="footer-nav-legal-container">
                <div class="footer-nav-legal-left">
                    <p class="legal">© 2019 CURLING CANADA. ALL RIGHTS RESERVED.</p>
                </div>
                <div class="footer-nav-legal-right">
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
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
<?php echo !WP_DEBUG ?: "<!-- End output from ".basename(__FILE__)." -->" ?>