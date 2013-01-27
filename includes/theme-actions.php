<?php
/**
 * Nimbus actions
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.2
 */

if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'nimbus_add_scripts' ); 	// Nimbus scripts
}

add_action( 'wp_head', 'nimbus_html5' ); 						// HTML5 shiv
add_action( 'init', 'nimbus_widgets_init' ); 					// Widgets
add_action( 'comment_form_defaults', 'nimbus_move_textarea' );	// Re-arrange comment form (text area first)
add_action( 'comment_form_top', 'nimbus_move_textarea' ); 		// Re-arrange comment form (text area first)
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 ); 	// Custom excerpt length
add_filter( 'excerpt_more', 'new_excerpt_more' ); 				// Custom excerpt more

/**
 * Theme Support
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'  ) );

/**
 * Main navigation
 */
register_nav_menu('main', __( 'Main menu', 'nimbus' ) );

/**
 * Editor Styles
 */
add_editor_style('css/editor-styles.css');