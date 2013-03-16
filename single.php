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

<?php nimbus_content_before(); ?>

<section class="content" role="main">

	<?php nimbus_content_top(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php nimbus_entry_top(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<?php nimbus_entry_bottom(); ?>

		</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; // end of the loop. ?>

	<?php comments_template( '', true ); ?>

	<?php nimbus_content_bottom(); ?>

</section><!-- /.content -->

<?php nimbus_content_after(); ?>

<?php get_footer(); ?>