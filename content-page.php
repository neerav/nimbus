<?php
/**
 * The template for displaying pages.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<?php
		if ( has_post_thumbnail()) {
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
			echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" class="zoom">';
				the_post_thumbnail();
			echo '</a>';
		}
	?>

	<div class="article-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'nimbus' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
