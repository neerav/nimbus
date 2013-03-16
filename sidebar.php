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

<?php nimbus_sidebar_before(); ?>

<aside class="sidebar" role="complementary">

	<?php nimbus_sidebar_top(); ?>

	<?php dynamic_sidebar( 'primary-sidebar' ); ?>

	<?php nimbus_sidebar_bottom(); ?>

</aside>

<?php nimbus_sidebar_after(); ?>