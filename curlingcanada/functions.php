<?php
function new_nav_menu_items($items,$args) {
	if (function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=0');
		if(1 < count($languages)){
			foreach($languages as $l){
				if(!$l['active']){
					if( $args->theme_location == 'top-menu' )
					$items = $items.'<li id="menu-item-7777" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7777 gdlr-normal-menu"><a href="'.$l['url'].'">'.$l['native_name'].'</a></li>';
				}
			}
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items',10,2 );

// Added by Valet 2018/10
add_action( 'wp_head', 'ed_google_analytics', 10 );

function ed_google_analytics() {
	if ( is_page( array( '2018canadacup', '2019continentalcup', '2019juniors', '2019scotties', '2019brier', '2019worldmen' ) ) ) {
			?>
				<!-- Global site tag (gtag.js) - Google Analytics -->
				<script async src="https://www.googletagmanager.com/gtag/js?id=UA-309217-65"></script>
				<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', 'UA-309217-65');
				</script>
			<?php
	}
}

?>
