<?php
/**
 * The header template.
 *
 * @package WordPress
 * @subpackage Nimbus
 * @since Nimbus 0.1
 */
?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?><?php nimbus_html_before(); ?><!doctype html><!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>

	<?php nimbus_head_top(); ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title( '/', true, 'right' ); ?></title>

	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php nimbus_head_bottom(); ?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php nimbus_body_top(); ?>

<div class="outer-wrap" id="top">

	<div class="inner-wrap">

	<?php nimbus_header_before(); ?>

	<?php
		$header_image = get_header_image();
	?>

	<header class="header" style="<?php if ( $header_image ) { echo 'background-image:url(' . $header_image . ')'; } ?>">

		<div class="wrapper">

			<?php nimbus_header(); ?>

		</div><!--/.wrapper-->

	</header>

	<?php nimbus_header_after(); ?>

	<div class="wrapper <?php if (!is_home()) echo 'not-home'; ?>">