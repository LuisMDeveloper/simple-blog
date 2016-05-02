<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Simple_Blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main" hidden><?php esc_html_e( 'Skip to content', 'simple-blog' ); ?></a>

	<div class="site-header">
		<header id="masthead" role="banner">
			<div class="header-row">
				<nav id="site-navigation" class="main-navigation navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a navbar-brand href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									<?php if ( $description || is_customize_preview() ) : ?>
										<small class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></small>
									<?php endif; ?>
								</h1>
							<?php else : ?>
								<h2 class="site-title"><a navbar-brand href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									<?php if ( $description || is_customize_preview() ) : ?>
										<small class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></small>
									<?php endif; ?>
								</h2>
								<?php
							endif;?>

						</div>

						<?php
						wp_nav_menu( array(
							'theme_location' 	=> 'primary',
							'menu_id'			=> 'primary-menu',
							'depth'             => 2,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse',
							'container_id'      => 'bs-example-navbar-collapse-1',
							'menu_class'        => 'nav navbar-nav navbar-right',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'			=> new wp_bootstrap_navwalker()
						) );
						?>
					</div>
				</nav>

				<!--<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'simple-blog' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</nav> #site-navigation -->
			</div>
		</header><!-- #masthead -->
	</div>


	<div id="content" class="site-content container">
		<div class="row">
