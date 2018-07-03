<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes() ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes() ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes() ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>">

	<!--[if lt IE 9]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="<?php echo get_template_directory_uri() ?>/js/vendor/html5shiv.js"></script>
	<![endif]-->
	<?php wp_head() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="https://plus.google.com/112164351198021730612" rel="publisher">
</head>
<body <?php body_class() ?>>
<div id="page" class="hfeed site">
	<?php if (get_header_image()): ?>
	<div id="site-header">
		<a href="<?php echo esc_url(home_url('/')) ?>" rel="home">
			<img src="<?php header_image() ?>" width="<?php echo get_custom_header()->width ?>" height="<?php echo get_custom_header()->height ?>" alt="">
		</a>
	</div>
	<?php endif ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-main container">
			<div class="row">
				<div class="col-md-3">
					<a href="<?php echo esc_url(home_url('/')) ?>" class="logo" rel="home"><?php bloginfo('name') ?></a>
					<div class="nav-menu-toggle-wrapper clearfix">
						<span class="nav-menu-toggle">
							<span class="nav-menu-toggle-button">
								<span class="line"></span><!-- .line -->
								<span class="line"></span><!-- .line -->
								<span class="line"></span><!-- .line -->
							</span><!-- .nav-menu-toggle-button -->
							<span class="nav-menu-toggle-text">MENU</span><!-- .nav-menu-toggle-text -->
						</span><!-- .nav-menu-toggle -->
					</div><!-- .nav-menu-toggle-wrapper -->
				</div><!-- .col-md-3 -->
				<div class="col-md-9 header-right-wrapper">
					<div class="header-right">
						<div class="clearfix">
							<?php dynamic_sidebar('header') ?>
						</div><!-- .clearfix -->
						<div class="nav-menu-wrapper">
							<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
								<?php wp_nav_menu(array(
									'theme_location' => 'primary',
									'menu_class' => 'nav-menu',
									'container' => false,
									'fallback_cb' => false,
								)) ?>
							</nav>
						</div><!-- .nav-menu-wrapper -->
					</div><!-- .header-right -->
				</div><!-- .col-md-9 -->
			</div><!-- .row -->
		</div><!-- .header-main container -->
	</header><!-- #masthead -->

	<div id="main" class="site-main">
		<div class="container home-container">
