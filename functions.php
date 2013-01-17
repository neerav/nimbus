<?php
/**
 * Nimbus functions and definitions
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*----------------------*/
/* Add theme support for post thumbnails, automatic feed links and post formats */
/*----------------------*/
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'  ) );

/*----------------------*/
/* Theme Options */
/*----------------------*/
require_once ( get_template_directory() . '/includes/theme-options.php' );

// Display logo based on theme option settings. Display my gravatar if not set.
if ( ! function_exists( 'nimbus_display_logo' ) ) {
	function nimbus_display_logo() {
		$admin_email = get_option('admin_email');
		?>
		<div class="logo">
			<a href="<?php echo home_url(); ?>" title="<?php get_bloginfo('name'); ?>">
				<img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $admin_email ) ) ); ?>?s=256&d=identicon&r=PG" alt="<?php get_bloginfo('name'); ?>" class="mugshot" />
				<span></span>
			</a>
		</div><!--/.logo-->
		<?php
	}
}

/*----------------------*/
/* Enqueue scripts */
/*----------------------*/
if ( ! is_admin() ) { add_action( 'wp_enqueue_scripts', 'nimbus_add_scripts' ); }

if ( ! function_exists( 'nimbus_add_scripts' ) ) {
	function nimbus_add_scripts() {
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
		wp_register_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
		wp_enqueue_script( 'nimbus-plugins', get_template_directory_uri() . '/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'nimbus-script', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'comment-reply' );
	}
}

// Add HTML5 shim in <IE9
add_action('wp_head', 'nimbus_html5');
function nimbus_html5() {
	global $is_IE;
	if($is_IE) {
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$browser = substr( "$browser", 25, 8);
		if ($browser == "MSIE 6.0" || $browser == "MSIE 7.0" || $browser == "MSIE 8.0" ) {
			wp_enqueue_script( 'html5shiv' );
		}
	}
}

/*----------------------*/
/* Register main nav */
/*----------------------*/
register_nav_menu('main', __( 'Main menu', 'nimbus' ) );

/*----------------------*/
/* Register Sidebar */
/*----------------------*/
add_action( 'init', 'nimbus_widgets_init' );

if (!function_exists( 'nimbus_widgets_init')) {
	function nimbus_widgets_init() {
	    register_sidebar(array(
		    'before_widget' => '<section class="widget">',
		    'after_widget' => '</section>',
		    'before_title' => '<h3>',
		    'after_title' => '</h3>',
		));	}
}

/*----------------------*/
/* Prepare featured images for mobile which are served conditionally (big props to http://viewportindustries.com/blog/automatic-responsive-images-in-wordpress/) */
/*----------------------*/
add_image_size('thumbnail-bw', 400, 0, false);

/*----------------------*/
/* Define content width */
/*----------------------*/
if ( ! isset( $content_width ) ) $content_width = 900;


/*----------------------*/
/* Post Meta */
/*----------------------*/
if ( ! function_exists( 'nimbus_post_meta' ) ) {
	function nimbus_post_meta() { ?>
		<div class="post-meta">
			<ul>
				<li class="comment"><?php comments_popup_link( __( '0 Comments', 'nimbus' ), __( '1 Comment', 'nimbus' ), __( '% Comments', 'nimbus' ) ); ?></li>
				<li class="permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'nimbus' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Permalink','nimbus'); ?></a></li>
				<li class="categories"><?php the_category(''); ?></li>
				<?php the_tags('<li class="tags">', '','</li>'); ?>
			</ul>
		<?php
			if ( is_single() ) {
				nimbus_post_nav();
			}
			?>
		</div><!-- /.post-meta-->
		<?php
	}
}

/*----------------------*/
/* Pagination */
/*----------------------*/
if ( ! function_exists( 'nimbus_content_nav' ) ) {
	/**
	 * Display navigation to next/previous pages when applicable (taken straight from TwentyEleven)
	 */
	function nimbus_content_nav( $nav_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo $nav_id; ?>" class="navigation">
				<div class="next"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer posts', 'nimbus' ) ); ?></div>
				<div class="prev"><?php next_posts_link( __( 'Older posts <span class="meta-nav">&rarr;</span>', 'nimbus' ) ); ?></div>
			</nav><!-- #nav-above -->
		<?php endif;
	}
}

/*----------------------*/
/* Post Pagination */
/*----------------------*/
if ( ! function_exists( 'nimbus_post_nav' ) ) {
	/**
	 * Display navigation to next/previous posts
	 */
	function nimbus_post_nav() {
		?>
			<nav class="navigation <?php if ( is_single() ) { echo 'single'; } ?>">
				<div class="next"><?php previous_post_link( '%link' ); ?></div>
				<div class="prev"><?php next_post_link( '%link' ); ?></div>
			</nav><!-- #nav-above -->
		<?php
	}
}

/*----------------------*/
/* Move text area in comment form above inputs */
/*----------------------*/
add_action( 'comment_form_defaults', 'nimbus_move_textarea' );
add_action( 'comment_form_top', 'nimbus_move_textarea' );
function nimbus_move_textarea( $input = array () ) {
    static $textarea = '';

    if ( 'comment_form_defaults' === current_filter() ) {
        // Copy the field to our internal variable …
        $textarea = $input['comment_field'];
        // … and remove it from the defaults array.
        $input['comment_field'] = '';
        return $input;
    }

    print $textarea;
}

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
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'nimbus' ), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__( '(Edit)', 'nimbus' ),'  ','' );
			?>
		</div>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'nimbus' ) ?></em>
		<br />
<?php endif; ?>

		<?php comment_text() ?>

		<div class="reply">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
        }

/*----------------------*/
/* Excerpt length */
/*----------------------*/
function custom_excerpt_length( $length ) {
	return 63;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*----------------------*/
/* Excerpt more */
/*----------------------*/
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*----------------------*/
/* Editor styles */
/*----------------------*/
add_editor_style('css/editor-styles.css');

/*----------------------*/
/* WooCommerce */
/*----------------------*/
if (class_exists('woocommerce')) {
	require_once ( get_template_directory() . '/includes/theme-woocommerce.php' );
	add_action( 'wp_enqueue_scripts', create_function("", "wp_enqueue_style( 'woocommerce' );"));
}