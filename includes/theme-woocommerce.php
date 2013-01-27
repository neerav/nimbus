<?php
// WooCommerce functions and overrides

// Remove content wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Fix content wrappers
add_action( 'woocommerce_before_main_content', 'nimbus_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'nimbus_after_content', 20 );
if (!function_exists('nimbus_before_content')) {
	function nimbus_before_content() { ?>
	    <div class="row">
	    	<section class="content woocommerce">
	<?php
	}
}

if (!function_exists('nimbus_after_content')) {
	function nimbus_after_content() {
	?>
		</section><!-- /.content -->
		<?php woocommerce_get_sidebar(); ?>
	    </div><!-- /.row-->
	    <?php
	}
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Display 12 products per page.
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

// Remove the breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Remove the add to cart button in the loop for neat-ness
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );