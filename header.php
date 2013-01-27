<?php
/**
 * The header template.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<!doctype html>

<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>

  <!--  Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

  <!-- CSS : implied media="all" -->
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <div class="wrapper <?php if (!is_home()) echo 'not-home'; ?>">

		<header class="header">


			<?php nimbus_display_logo(); ?>

			<?php if ( is_home() ) { ?>

			    <h1 class="site-title"><?php bloginfo('name'); ?></h1>

			<?php } else { ?>

			    <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>

			<?php } ?>

			<p class="intro"><?php bloginfo('description'); ?></p>

			<p class="toggle-container"><a href="#" class="nav-toggle button"><?php _e('Navigation','nimbus'); ?></a></p>

			<nav class="main-nav">

				<?php wp_nav_menu( array( 'menu' => 'main' ) ); ?>

			</nav>

			<hr />

		</header>

		<?php get_sidebar(); ?>