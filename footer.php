<?php
/**
 * The footer template.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

</div><!--/.wrapper-->

<hr />

<footer class="footer">

	<div class="wrapper">

		<p>
			<?php _e( 'Powered by', 'nimbus' ); ?> <a href="http://wordpress.org" title="WordPress.org">WordPress</a>. <?php _e( 'Theme: Nimbus by', 'nimbus' ); ?> <a href="http://jameskoster.co.uk/">James Koster</a>.
		</p>

	</div><!--/.wrapper-->

</footer>

</div><!--/.inner-wrap-->

</div><!--/.outer-wrap-->

<?php wp_footer(); ?>
</body>
</html>