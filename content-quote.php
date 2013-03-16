<?php
/**
 * The template for displaying quotes.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.2.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php
	if ( has_post_thumbnail()) {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" class="zoom">';
			the_post_thumbnail();
		echo '</a>';
	}
?>

<section class="article-content">

	<?php
		the_content();
		wp_link_pages();
	?>

</section><!-- /.article-content -->