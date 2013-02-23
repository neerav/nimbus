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
 */
if ( ! function_exists( 'nimbus_add_scripts' ) ) {
	function nimbus_add_scripts() {
		// Register styles
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );

		// Enqueue styles
		wp_enqueue_style( 'nimbus-styles', get_stylesheet_uri() );

		// Register scripts
		wp_register_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );

		// Enqueue Scripts
		wp_enqueue_script( 'nimbus-plugins', get_template_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'nimbus-script', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'comment-reply' );

		// Enqueue Google fonts
		wp_enqueue_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,700' );
		wp_enqueue_style( 'open-sans-condensed', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' );
		wp_enqueue_style( 'cantarell', 'http://fonts.googleapis.com/css?family=Cantarell' );
	}
}

/**
 * Display logo based on admin email
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
 * Add HTML5 shiv in <ie9
 */
if ( ! function_exists( 'nimbus_html5' ) ) {
	function nimbus_html5() {
		global $is_IE;
		if ( $is_IE ) {
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$browser = substr( "$browser", 25, 8);
			if ( $browser == "MSIE 6.0" || $browser == "MSIE 7.0" || $browser == "MSIE 8.0" ) {
				wp_enqueue_script( 'html5shiv' );
			}
		}
	}
}

/**
 * Widget init
 */
if ( ! function_exists( 'nimbus_widgets_init' ) ) {
	function nimbus_widgets_init() {
	    register_sidebar( array(
		    'before_widget' => '<section class="widget">',
		    'after_widget' => '</section>',
		    'before_title' => '<h3>',
		    'after_title' => '</h3>',
		) );
	}
}


/**
 * Post Meta
 */
if ( ! function_exists( 'nimbus_post_meta' ) ) {
	function nimbus_post_meta() { ?>
		<div class="post-meta">
			<ul>
				<li class="comment"><?php comments_popup_link( __( '0 Comments', 'nimbus' ), __( '1 Comment', 'nimbus' ), __( '% Comments', 'nimbus' ) ); ?></li>
				<li class="permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'nimbus' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Permalink', 'nimbus' ); ?></a></li>
				<li class="categories"><?php the_category(', '); ?></li>
				<?php the_tags( '<li class="tags">', ', ','</li>' ); ?>
			</ul>
			<?php if ( is_single() ) {
				nimbus_post_nav();
			} ?>
		</div><!-- /.post-meta-->
	<?php }
}

/**
 * Archive Pagination
 */
if ( ! function_exists( 'nimbus_content_nav' ) ) {
	function nimbus_content_nav( $nav_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo $nav_id; ?>" class="navigation">
				<div class="next"><?php next_posts_link( __( 'Older posts <span class="meta-nav">&rarr;</span>', 'nimbus' ) ); ?></div>
				<div class="prev"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer posts', 'nimbus' ) ); ?></div>
			</nav><!-- #nav-above -->
		<?php endif;
	}
}

/**
 * Post Pagination
 */
if ( ! function_exists( 'nimbus_post_nav' ) ) {
	function nimbus_post_nav() { ?>
			<nav class="navigation <?php if ( is_single() ) { echo 'single'; } ?>">
				<div class="prev"><?php previous_post_link( '%link' ); ?></div>
				<div class="next"><?php next_post_link( '%link' ); ?></div>
			</nav><!-- #nav-above -->
	<?php }
}

/**
 * Move textarea above name / email / address in comment form
 */
if ( ! function_exists( 'nimbus_move_textarea' ) ) {
	function nimbus_move_textarea( $input = array () ) {
	    static $textarea = '';

	    if ( 'comment_form_defaults' === current_filter() ) {
	        $textarea = $input['comment_field']; 	// Copy the field to our internal variable …
	        $input['comment_field'] = ''; 			// … and remove it from the defaults array.
	        return $input;
	    }

	    print $textarea;
	}
}

/**
 * Comment Template
 */
if ( ! function_exists( 'nimbus_comment' ) ) {
	function nimbus_comment($comment, $args, $depth) {
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
			</div><!--/.reply-->
			<?php if ( 'div' != $args['style'] ) { ?>
		</div>
		<hr/>
		<?php } ?>
	<?php
	}
}


/**
 * Custom excerpt length
 */
if ( ! function_exists( 'nimbus_excerpt_length' ) ) {
	function nimbus_excerpt_length( $length ) {
		return 63;
	}
}

/**
 * Custom excerpt more
 */
if ( ! function_exists( 'nimbus_excerpt_more' ) ) {
	function nimbus_excerpt_more( $more ) {
		return '...';
	}
}