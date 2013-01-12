<?php
/**
 * The template for displaying single posts.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header(); 
?>

<section class="content" role="main">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>					
	
	<?php get_template_part( 'content', get_post_format() ); ?>
	
	<?php endwhile; // end of the loop. ?>
	
	<?php comments_template( '', true ); ?>

</section>
	
<?php get_footer(); ?>
