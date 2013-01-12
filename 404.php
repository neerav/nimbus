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

	<section class="<?php post_class(); ?> content page" role="main">

	<h1><?php _e('404 not found', 'nimbus'); ?></h1>

	</section>

<?php get_footer(); ?>