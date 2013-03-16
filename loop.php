<?php
/**
 * The loop template.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php nimbus_entry_before(); ?>

<div class="post-wrap">

<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php nimbus_entry_top(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php nimbus_entry_bottom(); ?>

	</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; ?>

</div><!--/.post-wrap-->

<?php nimbus_entry_after(); ?>