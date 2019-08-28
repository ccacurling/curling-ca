<?php 
    $output = ''; 
    $output = 'style="background-color:#fff;padding: 30px 0 30px;"';
?>

<?php if (!is_front_page()) { ?>

<div class="sub-title" <?php echo $output;?>>
    <div class="container">
        <div class="sub-title-inner">
            <h2 style="text-transform: uppercase;">
            	<?php
	            	if( is_home() && get_option( 'page_for_posts' ) )
	            	{
	            		echo get_the_title( get_option( 'page_for_posts' ) );
	            	}
	            	elseif (is_archive()) {
	            		global $wp_query;
	            		echo $wp_query->queried_object->name;
	            	}
	            	else
	            	{
						the_title();
	            	}
            	?>
            </h2>
            <?php /** themeum_breadcrumbs(); */ ?>
        </div>
    </div>
</div>

<?php } ?>