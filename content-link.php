<?php
/**
 * The template for displaying posts with the link post format.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<article <?php post_class(); ?>>
	<?php
		$content = get_the_content();
		$linktoend = stristr($content, "http" );
		$afterlink = stristr($linktoend, ">");
		if ( ! strlen( $afterlink ) == 0 ):
		$linkurl = substr($linktoend, 0, -(strlen($afterlink) + 1));
		else:
		$linkurl = $linktoend;
		endif;
	?>
	<header class="post-header">
		<time class="post-date"><?php the_time(get_option('date_format')); ?></time>
		<h1><a href="<?php echo $linkurl; ?>" rel="external" title="<?php _e('External link to', 'nimbus'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>
		<?php
			if ( is_single() ) {
				nimbus_post_nav();
			}
		?>
	</header>
</article>