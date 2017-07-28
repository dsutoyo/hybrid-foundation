<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head <?php hybrid_attr( 'head' ); ?>>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

<div id="container" class="off-canvas-wrapper">

	<div class="off-canvas position-left" id="offCanvas" data-off-canvas data-transition="push">
		<?php hybrid_get_menu( 'mobile' ); ?>
	</div>

	<div class="off-canvas-content" data-off-canvas-content>

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'hybrid-base' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php if ( !current_theme_supports( 'popup-navigation' ) ) : ?>

			<nav class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
				<button type="button" class="menu-icon" data-toggle="offCanvas"></button>
				<div class="title-bar-title">
					<?php bloginfo( 'name' ); ?>
				</div>
			</nav>

			<?php endif; ?>

			<div class="top-bar" data-topbar>

				<div class="top-bar-title">
					<ul <?php hybrid_attr( 'branding' ); ?>>
					<?php if ( display_header_text() ) : // If user chooses to display header text. ?>

						<li class="name"><?php hybrid_site_title(); ?></li>
						<li class="description"><?php hybrid_site_description(); ?></li>

					<?php elseif ( get_header_image() && !display_header_text() ) : // If there's a header image but no header text. ?>

						<li class="name"><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img class="header-image" src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="" /></a></li>

					<?php elseif ( get_header_image() ) : // If there's a header image. ?>

						<li class="name"><img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></li>

					<?php endif; // End check for header image. ?>

					</ul><!-- #branding -->
				</div>

			<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

			</div>

			<?php if ( current_theme_supports( 'popup-navigation' ) ) : ?>

			<a class="popup-navigation-trigger" href="#">Menu</a>

			<?php endif; ?>

		</header><!-- #header -->

		<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

		<div id="main" class="main">

			<div class="wrap">

			<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
