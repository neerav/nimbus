<?php
// WooCommerce functions and overrides

// Remove content wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


// Remove sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


// Fix content wrappers
add_action( 'woocommerce_before_main_content', 'nimbus_before_woocommerce_content_wrapper', 10 );
add_action( 'woocommerce_after_main_content', 'nimbus_after_woocommerce_content_wrapper', 20 );
if ( ! function_exists( 'nimbus_before_woocommerce_content_wrapper' ) ) {
	function nimbus_before_woocommerce_content_wrapper() { ?>

		    <?php nimbus_content_before(); ?>

		    <section class="content woocommerce">

		    	<?php nimbus_content_top(); ?>
	<?php
	}
}

if ( ! function_exists( 'nimbus_after_woocommerce_content_wrapper' ) ) {
	function nimbus_after_woocommerce_content_wrapper() {
	?>

				<?php nimbus_content_bottom(); ?>

			</section><!-- /.content -->

			<?php nimbus_content_after(); ?>

	    <?php
	}
}


// Change number or products per row to 3
add_filter( 'loop_shop_columns', 'nimbus_product_columns' );
if ( ! function_exists( 'nimbus_product_columns' ) ) {
	function nimbus_product_columns() {
		return 3; // 3 products per row
	}
}


// Display 12 products per page.
add_filter( 'loop_shop_per_page', 'nimbus_products_per_page', 20 );
if ( ! function_exists( 'nimbus_products_per_page' ) ) {
	function nimbus_products_per_page() {
		return 12; // 12 products per page
	}
}


// Remove the breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Remove the add to cart button in the loop for neat-ness
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );