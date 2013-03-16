<?php
/**
 * Nimbus Hooks
 * Action hooks used in the Nimbus theme
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.3
 */


/**
 * Nimbus before html action
 * @since Nimbus 0.3
 */
function nimbus_html_before() {
    do_action( 'nimbus_html_before' );
    tha_html_before();
}


/**
 * Nimbus body top action
 * @since Nimbus 0.3
 */
function nimbus_body_top() {
    do_action( 'nimbus_body_top' );
    tha_body_top();
}


/**
 * Nimbus body bottom action
 * @since Nimbus 0.3
 */
function nimbus_body_bottom() {
    do_action( 'nimbus_body_bottom' );
    tha_body_bottom();
}


/**
 * Nimbus head top action
 * @since Nimbus 0.3
 */
function nimbus_head_top() {
    do_action( 'nimbus_head_top' );
    tha_head_top();
}


/**
 * Nimbus head bottom action
 * @since Nimbus 0.3
 */
function nimbus_head_bottom() {
    do_action( 'nimbus_head_top' );
    tha_head_bottom();
}


/**
 * Nimbus before header wrapper action
 * @since Nimbus 0.3
 */
function nimbus_header_before() {
    do_action( 'nimbus_header_before' );
    tha_header_before();
}


/**
 * Nimbus after header wrapper action
 * @since Nimbus 0.3
 */
function nimbus_header_after() {
    do_action( 'nimbus_header_after' );
    tha_header_after();
}


/**
 * Nimbus header action
 * @since Nimbus 0.3
 */
function nimbus_header() {
	tha_header_top();
    do_action( 'nimbus_header' );
    tha_header_bottom();
}


/**
 * Nimbus before content wrapper action
 * @since Nimbus 0.3
 */
function nimbus_content_before() {
    do_action( 'nimbus_content_before' );
    tha_content_before();
}


/**
 * Nimbus after content wrapper action
 * @since Nimbus 0.3
 */
function nimbus_content_after() {
    do_action( 'nimbus_content_after' );
    tha_content_after();
}


/**
 * Nimbus before content action
 * @since Nimbus 0.3
 */
function nimbus_content_top() {
    do_action( 'nimbus_content_top' );
    tha_content_top();
}


/**
 * Nimbus after content action
 * @since Nimbus 0.3
 */
function nimbus_content_bottom() {
    do_action( 'nimbus_content_bottom' );
    tha_content_bottom();
}

/**
 * Nimbus before entry wrapper action
 * @since Nimbus 0.3
 */
function nimbus_entry_before() {
    do_action( 'nimbus_entry_before' );
    tha_entry_before();
}


/**
 * Nimbus after entry wrapper action
 * @since Nimbus 0.3
 */
function nimbus_entry_after() {
    do_action( 'nimbus_entry_after' );
    tha_entry_after();
}


/**
 * Nimbus entry top action
 * @since Nimbus 0.3
 */
function nimbus_entry_top() {
    do_action( 'nimbus_entry_top' );
    tha_entry_top();
}


/**
 * Nimbus entry bottom action
 * @since Nimbus 0.3
 */
function nimbus_entry_bottom() {
    do_action( 'nimbus_entry_bottom' );
    tha_entry_bottom();
}


/**
 * Nimbus before comments action
 * @since Nimbus 0.3
 */
function nimbus_comments_before() {
    do_action( 'nimbus_comments_before' );
    tha_comments_before();
}


/**
 * Nimbus after comments wrapper action
 * @since Nimbus 0.3
 */
function nimbus_comments_after() {
    do_action( 'nimbus_comments_after' );
    tha_comments_after();
}


/**
 * Nimbus before sidebar action
 * @since Nimbus 0.3
 */
function nimbus_sidebar_before() {
    do_action( 'nimbus_sidebar_before' );
    tha_sidebars_before();
}


/**
 * Nimbus after sidebar wrapper action
 * @since Nimbus 0.3
 */
function nimbus_sidebar_after() {
    do_action( 'nimbus_sidebar_after' );
    tha_sidebars_after();
}


/**
 * Nimbus sidebar top
 * @since Nimbus 0.3
 */
function nimbus_sidebar_top() {
    do_action( 'nimbus_sidebar_top' );
    tha_sidebar_top();
}


/**
 * Nimbus sidebar bottom
 * @since Nimbus 0.3
 */
function nimbus_sidebar_bottom() {
    do_action( 'nimbus_sidebar_bottom' );
    tha_sidebar_bottom();
}


/**
 * Nimbus before footer wrapper action
 * @since Nimbus 0.3
 */
function nimbus_footer_before() {
    do_action( 'nimbus_footer_before' );
    tha_footer_before();
}


/**
 * Nimbus after footer wrapper action
 * @since Nimbus 0.3
 */
function nimbus_footer_after() {
    do_action( 'nimbus_footer_after' );
    tha_footer_after();
}


/**
 * Nimbus footer action
 * @since Nimbus 0.3
 */
function nimbus_footer() {
	tha_footer_top();
    do_action( 'nimbus_footer' );
    tha_footer_bottom();
}