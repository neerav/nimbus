<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="post-wrap">
			
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', get_post_format() ); ?>

<?php endwhile; ?>

</div><!--/.post-wrap-->