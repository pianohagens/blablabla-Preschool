<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stiff
 */

$stiff_search = get_theme_mod( 'home_general_hidesearch', true );


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'stiff' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding col-md-4">

			<?php if ( has_custom_logo() ) { ?>
				<div class="custom-logo">			
					<?php the_custom_logo(); ?>
				</div>
			<?php } else {?>
				<div class="text-logo">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
				<p class="site-title site-description"><?php bloginfo( 'description' ); ?></p>
				</div>
			<?php } ?>
			</div><!-- .container -->

			<div class="col-md-8">
			<?php if ( get_header_image() ) { ?>
				<div class="header-image">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>">
					</a>
				</div>
			<?php } ?>
			</div>

		</div><!-- .site-branding -->

		
		<nav id="site-navigation" class="main-navigation " role="navigation">
			<span class="header-menu-button"><i class="fa fa-bars"></i></span>
			<div id="main-menu" class="container cintron-mobile-menu-standard-color-scheme">
				<div class="main-menu-close"><i class="fa fa-angle-right"></i><i class="fa fa-angle-left"></i></div>
				<?php wp_nav_menu( array( 
						'theme_location' => 'primary', 
						'container_class' => 'main-navigation-inner' 
						) 
					); 
				?>
				<div class="search-bar float-r">
					<?php if ( $stiff_search == true ){ get_search_form(); } ?>
				</div>
			</div>

		</nav><!--#site-navigation -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">
