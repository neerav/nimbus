<?php
/**
 * The template for displaying 404 pages (Not Found).
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

	<section role="main">

	<h1><?php _e('404 not found', 'nimbus'); ?></h1>

	<p><?php _e( 'It seems the page you\'re looking for no longer (or indeed never did) exist at this location. Please try searching...', 'nimbus' ); ?>

	<?php get_search_form(); ?>

	</section>

</section>

<?php get_footer(); ?>