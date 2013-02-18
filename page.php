<?php
/**
 * The page template.
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

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop. ?>

</section><!-- #content -->

<?php get_footer(); ?>