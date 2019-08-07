<?php
$footer_widgets = tie_get_option( 'footer_widgets' ) ? tie_get_option( 'footer_widgets' ) : "footer-3c" ;
if( $footer_widgets != 'disable' ): ?>
<footer class="fade-in animated4">
	<div id="footer-widget-area" class="<?php echo $footer_widgets ?> container">

	<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
		<div id="footer-first" class="footer-widgets-box">
			<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
		<div id="footer-second" class="footer-widgets-box">
			<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
		</div><!-- #second .widget-area -->
	<?php endif; ?>


	
		<div id="footer-third" class="footer-widgets-box last-social">
			<?php if( tie_get_option('footer_social') ) tie_get_social( 'yes' , 'flat' , 'ttip' , true ); ?>
		</div><!-- #third .widget-area -->
	
	
	</div><!-- #footer-widget-area -->
	<div class="clear"></div>
</footer><!-- .Footer /-->
<?php endif; ?>