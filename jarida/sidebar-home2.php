<?php
if(tie_get_option( 'columns_num' ) != '2c'):
?>
<aside class="sidebar-narrow">
<?php
	dynamic_sidebar( 'homepage-narrow-widget-area2' );
?>
</aside>
<?php endif; ?>
</div> <!-- .content-wrap -->
<aside class="sidebar">
<?php
	dynamic_sidebar( 'homepage-normal-widget-area2' );
?>
</aside>
<div class="clear"></div>