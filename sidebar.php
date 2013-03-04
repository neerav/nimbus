<?php
/**
 * The sidebar template.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<aside class="sidebar" role="complementary">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside>