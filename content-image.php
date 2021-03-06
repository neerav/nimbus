<?php
/**
 * The template for displaying posts with the image post format.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<header class="post-header">

	<time class="post-date"><?php the_time(get_option('date_format')); ?></time>
	<h1 class="title" data-text="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'nimbus' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

</header><!-- /.post-header -->

<section class="article-content">

	<?php
	if ( has_post_thumbnail()) {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" class="zoom">';
			the_post_thumbnail();
		echo '</a>';
	}
	?>

	<?php
		the_content();
		wp_link_pages();
	?>

</section><!-- /.article-content -->