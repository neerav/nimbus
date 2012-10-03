<?php get_header(); ?>

<div class="row">

	<section id="content" class="eightcol single" role="main">
	
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>					
		
		<?php get_template_part( 'content', get_post_format() ); ?>
		
		<?php endwhile; // end of the loop. ?>
		
		<?php comments_template( '', true ); ?>
	
	</section>
	
</div><!--/.row-->

<?php get_footer(); ?>
