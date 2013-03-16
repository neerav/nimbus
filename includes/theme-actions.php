<?php
/**
 * Nimbus actions
 * Functions hooked into actions
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.2
 */

/**
 * Setup / Init
 */
if ( ! is_admin() ) {
    add_action( 'wp_enqueue_scripts',       'nimbus_add_scripts' );             // Nimbus scripts
}
add_action( 'after_setup_theme',            'nimbus_setup' );                   // Set up the theme
add_action( 'widgets_init',                 'nimbus_widgets_init' );            // Widgets


/**
 * Header
 */
add_action( 'nimbus_header',                'nimbus_display_logo', 10 );        // Logo
add_action( 'nimbus_header',                'nimbus_site_title', 20 );          // Site title
add_action( 'nimbus_header',                'nimbus_main_navigation', 30 );     // Navigation
add_action( 'nimbus_header_after',  		'nimbus_hr', 10 );                  // Header hr


/**
 * Loop
 */
add_action( 'nimbus_entry_after',   		'nimbus_content_nav', 10 );         // Post navigation


/**
 * Content
 */
add_action( 'nimbus_entry_bottom', 			'nimbus_post_meta', 10 );


/**
 * Footer
 */
add_action( 'nimbus_footer',                'nimbus_credit', 10 );              // Footer credit
add_action( 'nimbus_footer',                'nimbus_back_to_top', 20 );         // Back to top link
add_action( 'nimbus_footer_before', 		'nimbus_hr', 10 );                  // Footer hr


/**
 * Sidebar
 */
add_action( 'nimbus_content_after', 		'nimbus_sidebar' );                 // The sidebar


/**
 * Comments
 */
add_action( 'comment_form_defaults',        'nimbus_move_textarea' );           // Re-arrange comment form (text area first)
add_action( 'comment_form_top',             'nimbus_move_textarea' );			  // Re-arrange comment form (text area first)


/**
 * Filters
 */
add_filter( 'excerpt_length',               'nimbus_excerpt_length', 999 );     // Custom excerpt length
add_filter( 'excerpt_more',                 'nimbus_excerpt_more' );            // Custom excerpt more
add_filter( 'wp_title',                     'nimbus_wp_title', 10, 2 );         // Customise wp_title()


/**
 * Navigation
 */
register_nav_menu( 'main', __( 'Main menu', 'nimbus' ) );                       // Register main nav


/**
 * Editor styles
 */
add_editor_style( 'css/editor-styles.css' );                                    // Add editor styles