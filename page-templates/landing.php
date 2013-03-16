<?php
/**
 * Template Name: Landing Page
 *
 * The landing page template. Full width, no comments, featuring three footer widget regions
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

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php nimbus_entry_top(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php nimbus_entry_bottom(); ?>

		</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; // end of the loop. ?>

	<?php nimbus_content_bottom(); ?>

</section><!-- /.content -->

<?php nimbus_content_after(); ?>

<?php get_footer(); ?>