<?php
/**
 * Nimbus functions
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.2
 */

/**
 * Setup Theme
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_setup' ) ) {
	function nimbus_setup() {
		add_theme_support( 'post-thumbnails' );										// Enable Post Thumbnails
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		/**
		 * Define content width
		 * @var integer
		 */
		if ( ! isset( $content_width ) ) $content_width = 900;
	}
}


/**
 * Enqueue scripts
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_add_scripts' ) ) {
	function nimbus_add_scripts() {
		$options = nimbus_get_theme_options();
    	$current_typography = $options['theme_typography'];

		// Register styles
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );

		// Enqueue styles
		wp_enqueue_style( 'nimbus-styles', get_stylesheet_uri() );

		// Enqueue Scripts
		wp_enqueue_script( 'nimbus-plugins', get_template_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'nimbus-script', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array( 'jquery' ), '2.6.2' );
		wp_enqueue_script( 'comment-reply' );

		// Enqueue Google fonts if typography setting requires it
		if ( 'open-sans' == $current_typography ) {
			wp_enqueue_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,700' );
			wp_enqueue_style( 'open-sans-condensed', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' );
		}
		if ( 'merriweather' == $current_typography ) {
			wp_enqueue_style( 'merriweather', 'http://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700' );
		}
		if ( 'domine' == $current_typography ) {
			wp_enqueue_style( 'domine', 'http://fonts.googleapis.com/css?family=Domine:400,700' );
		}
	}
}


/**
 * Display logo based on admin email
 * Hooked into nimbus_header()
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_display_logo' ) ) {
	function nimbus_display_logo() {
		$admin_email = get_option( 'admin_email' ); ?>
		<div class="logo">
			<a href="<?php echo esc_url(home_url()); ?>" title="<?php get_bloginfo( 'name' ); ?>">
				<?php echo get_avatar( $admin_email, 256 ); ?>
				<span></span>
			</a>
		</div><!--/.logo-->
	<?php }
}

/**
 * Site title
 * Displays the site title and description
 * Hooked into nimbus_header()
 * @since  0.3
 */
function nimbus_site_title() {
	?>
	<?php if ( is_home() ) { ?>

	    <h1 class="site-title"><?php bloginfo('name'); ?></h1>

	<?php } else { ?>

	    <h1 class="site-title"><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a></h1>

	<?php } ?>

	<p class="intro">
		<?php bloginfo( 'description' ); ?>
	</p><!-- /.intro -->
	<?php
}

/**
 * Navigation
 * Displays the main navigation
 * Hooked into nimbus_header()
 * @since  0.3
 */
function nimbus_main_navigation() {
	?>
	<p class="toggle-container"><a href="#" class="nav-toggle button"><?php _e( 'Navigation','nimbus' ); ?></a></p>

	<nav class="main-nav" id="navigation" role="navigation">

		<ul class="buttons">

			<li class="home"><a href="<?php echo home_url(); ?>" class="nav-home button"><span><?php _e( 'Home', 'nimbus' ); ?></span></a></li>

			<li class="close"><a href="#top" class="nav-close button"><span><?php _e( 'Return to Content', 'nimbus' ); ?></span></a></li>

		</ul>

		<hr />

		<?php echo '<h3>' . woo_get_menu_name( 'main' ) . '</h3>'; ?>

		<?php wp_nav_menu( array( 'theme_location' => 'main', 'menu_class' => 'menu' ) ); ?>

	</nav><!-- /.main-nav -->
	<?php
}


/**
 * Widget init
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_widgets_init' ) ) {
	function nimbus_widgets_init() {
	    register_sidebar( array(
	    	'name'          => __( 'Sidebar', 'nimbus' ),
			'id'            => 'primary-sidebar',
		    'before_widget' => '<section class="widget">',
		    'after_widget' 	=> '</section>',
		    'before_title' 	=> '<h3>',
		    'after_title' 	=> '</h3>',
		) );
	}
}


/**
 * Sidebar
 * Displays the sidebar
 */
if ( ! function_exists( 'nimbus_sidebar' ) ) {
	function nimbus_sidebar() {
		if ( is_page() && ! is_page_template( 'page-templates/landing.php' ) ) {
			get_sidebar( 'page' );
		} else if ( is_single() ) {
			get_sidebar( 'single' );
		} else if ( is_woocommerce_activated() && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
			get_sidebar( 'shop' );
		} else if ( ! is_page_template( 'page-templates/landing.php' ) ) {
			get_sidebar();
		}
	}
}


/**
 * Post Meta
 * @since  0.1
 * Hooked into nimbus_entry_bottom()
 */
if ( ! function_exists( 'nimbus_post_meta' ) ) {
	function nimbus_post_meta() {
		if ( ! is_page() ) {
		?>
		<aside class="post-meta">
			<ul>
				<li class="comment"><?php comments_popup_link( __( '0 Comments', 'nimbus' ), __( '1 Comment', 'nimbus' ), __( '% Comments', 'nimbus' ) ); ?></li>
				<li class="permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'nimbus' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Permalink', 'nimbus' ); ?></a></li>
				<li class="categories"><?php the_category(', '); ?></li>
				<?php the_tags( '<li class="tags">', ', ','</li>' ); ?>
			</ul>
			<?php nimbus_post_nav(); ?>
		</aside><!-- /.post-meta -->
		<?php }
	}
}

/**
 * Archive Pagination
 * @since  0.1
 * Hooked into nimbus_entry_after()
 */
if ( ! function_exists( 'nimbus_content_nav' ) ) {
	function nimbus_content_nav() {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav class="navigation">
				<div class="next"><?php next_posts_link( __( 'Older posts <span class="meta-nav">&rarr;</span>', 'nimbus' ) ); ?></div>
				<div class="prev"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer posts', 'nimbus' ) ); ?></div>
			</nav><!-- /.navigation -->
		<?php endif;
	}
}

/**
 * Post Pagination
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_post_nav' ) ) {
	function nimbus_post_nav() {
		if ( is_single() ) {
		?>
			<nav class="navigation <?php if ( is_single() ) { echo 'single'; } ?>">
				<div class="prev"><?php previous_post_link( '%link' ); ?></div>
				<div class="next"><?php next_post_link( '%link' ); ?></div>
			</nav><!-- /.navigation -->
	<?php }
	}
}

/**
 * Move textarea above name / email / address in comment form
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_move_textarea' ) ) {
	function nimbus_move_textarea( $input = array () ) {
	    static $textarea = '';

	    if ( 'comment_form_defaults' === current_filter() ) {
	        $textarea = $input['comment_field']; 	// Copy the field to our internal variable …
	        $input['comment_field'] = ''; 			// … and remove it from the defaults array.
	        return $input;
	    }

	    if ( is_singular( 'post' ) || is_page() ) {
			print $textarea;
		}
	}
}

/**
 * Comment Template
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_comment' ) ) {
	function nimbus_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php } ?>
			<div class="comment-author vcard">
				<?php if ( $args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>

				<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="date-link"><?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'nimbus' ), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__( '(Edit)', 'nimbus' ),'  ','' );
					?>
				</div>
				<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ) ?>
			</div>

			<?php if ($comment->comment_approved == '0') { ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'nimbus' ) ?></em>
				<br />
			<?php } ?>

			<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</div><!-- /.reply -->
			<?php if ( 'div' != $args['style'] ) { ?>
		</div><!-- /.comment-body -->
		<hr/>
		<?php } ?>
	<?php
	}
}


/**
 * Get menu name
 * @since  0.3
 */
function woo_get_menu_name( $location ){
    if( ! has_nav_menu( $location ) ) return false;
    $menus = get_nav_menu_locations();
    $menu_title = wp_get_nav_menu_object( $menus[$location] ) -> name;
    return $menu_title;
}


/**
 * Credit
 * @since  0.3
 * Hooked into nimbus_footer
 */
function nimbus_credit() {
	?>
	<p>
		<?php _e( 'Powered by', 'nimbus' ); ?> <a href="http://wordpress.org" title="WordPress.org">WordPress</a>. <?php _e( 'Theme: Nimbus by', 'nimbus' ); ?> <a href="http://jameskoster.co.uk/">James Koster</a>.
	</p>
	<?php
}


/**
 * Back to top link
 * @since  0.3
 * Hooked into nimbus_footer
 */
function nimbus_back_to_top() {
	?>
		<a href="#top" class="back-to-top button">
			<?php _e( 'Back to top', 'nimbus' ); ?>
		</a>
	<?php
}


/**
 * Custom excerpt length
 * Changes the excerpt length to 63 words
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_excerpt_length' ) ) {
	function nimbus_excerpt_length( $length ) {
		return 63;
	}
}

/**
 * Custom excerpt more
 * Replaces the standard '[...]' with '...'
 * @since  0.1
 */
if ( ! function_exists( 'nimbus_excerpt_more' ) ) {
	function nimbus_excerpt_more( $more ) {
		return '...';
	}
}



/**
 * Simply outputs an <hr>
 * @since  0.3
 */
if ( ! function_exists( 'nimbus_hr' ) ) {
	function nimbus_hr() {
		echo '<hr />';
	}
}


/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since 0.3
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function nimbus_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'nimbus' ), max( $paged, $page ) );

	return $title;
}


/**
 * WooCommerce check
 * Checks if WooCommerce is activated
 * @since  0.3
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}