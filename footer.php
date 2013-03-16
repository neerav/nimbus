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

		<?php nimbus_footer_before(); ?>

		<footer class="footer">

			<div class="wrapper">

				<?php nimbus_footer(); ?>

			</div><!--/.wrapper-->

		</footer>

		<?php nimbus_footer_after(); ?>

	</div><!--/.inner-wrap-->

</div><!--/.outer-wrap-->

<?php nimbus_body_top(); ?>

<?php wp_footer(); ?>

</body>
</html>