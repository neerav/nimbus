<?php
/**
 * Nimbus functions and definitions
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Load theme options
require_once ( get_template_directory() . '/includes/theme-options.php' );

// Load theme functions
require_once ( get_template_directory() . '/includes/theme-functions.php' );

// Load theme actions
require_once ( get_template_directory() . '/includes/theme-actions.php' );

// Lod WooCommerce functions if WooCommerce is activated
if (class_exists('woocommerce')) {
	require_once ( get_template_directory() . '/includes/theme-woocommerce.php' );
	add_action( 'wp_enqueue_scripts', create_function("", "wp_enqueue_style( 'woocommerce' );"));
}