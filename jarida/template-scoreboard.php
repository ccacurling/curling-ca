<?php 
/*
Template Name: Scoreboard Page
*/
?>
<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
				
		<article class="post-listing post">
			<div class="post-inner">
				<div class="entry">
					<?php the_content(); ?>
					
				</div><!-- .entry /-->	
			
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
				
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>