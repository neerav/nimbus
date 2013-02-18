<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( __( 'You do not have sufficient permissions to access this page!', 'nimbus' ) );
}
?>

<?php get_header(); ?>

<section class="content" role="main">
	<?php if ( have_posts() ) : ?>

		<?php get_template_part( 'loop' ); ?>

		<?php nimbus_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'nimbus' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'nimbus' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>
</section>

<?php get_footer(); ?>