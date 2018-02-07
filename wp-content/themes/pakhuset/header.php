<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pakhuset
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pakhuset' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="main-nav">
			<div class="row-wrapper ph-header">
				<div class="col-full-2 logo-area">
					<div class="logo">
					<?php the_custom_logo(); ?>
					</div>
				</div>

					<div class="col-full-10 top-con">
						<div class="top">
								<a href="member-login" class="member">
									BLIV MEDLEM / LOG IN
								</a>
								<div class="search"><i class="fa fa-search" aria-hidden="true"></i><?php get_search_form(); ?></div>
							</div>
						<div class="bottom">
							<div class="col-full-12 menucon">
								<?php wp_nav_menu( array(
									'theme_location' => 'forside-menu',
									'menu_id'        => 'forside-menu',
									) ); 
								?>
							</div>
						</div>
					</div>
			
					<div id="mmenu" class="col-4">
						<a class="mobile-menu-toggle js-toggle-menu hamburger-menu" href="#">
							<span class="menu-item"></span>
							<span class="menu-item"></span>
							<span class="menu-item"></span>
						</a>
						<div class="mobile-dropdown">
							<?php  wp_nav_menu( array(
								'menu'           => 'Forside Menu', 
								'theme_location' => 'header',
								'menu_id' => 'mobile-nav'
								) );
							?>
						</div>
					</div>
				</div>
			</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">