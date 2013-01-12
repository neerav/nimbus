<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header(); 
?>

<section class="content" role="main">
	<?php if (is_category()) { ?>
	
    	<h1 class="archive-header category">
    		<?php _e( 'Category', 'nimbus' ); ?> / <?php echo single_cat_title(); ?>
    	</h1>        
    
        <?php } elseif (is_day()) { ?>
        <h1 class="archive-header date"><?php _e( 'Archive', 'nimbus' ); ?> / <?php the_time( get_option( 'date_format' ) ); ?></h1>

        <?php } elseif (is_month()) { ?>
        <h1 class="archive-header date"><?php _e( 'Archive', 'nimbus' ); ?> / <?php the_time( 'F, Y' ); ?></h1>

        <?php } elseif (is_year()) { ?>
        <h1 class="archive-header date"><?php _e( 'Archive', 'nimbus' ); ?> / <?php the_time( 'Y' ); ?></h1>

        <?php } elseif (is_author()) { ?>
        <h1 class="archive-header date"><?php _e( 'Author', 'nimbus' ); ?></h1>
        
        <?php } elseif (is_tag()) { ?>
        <h1 class="archive-header tag"><?php _e( 'Tag', 'nimbus' ); ?> / <?php echo single_tag_title( '', true ); ?></h1>
        
    <?php } ?>
	
	<?php if ( have_posts() ) : ?>
	
		<?php get_template_part( 'loop' ); ?>
		
		<?php nimbus_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'nimbus' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'nimbus' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>
</section>
	
<?php get_footer(); ?>