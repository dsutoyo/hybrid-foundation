<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container" class="off-canvas-wrap" data-offcanvas>

		<div class="inner-wrap">

		<?php hybrid_get_menu( 'mobile' ); ?>

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php _e( 'Skip to content', 'hybrid-base' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php if ( !current_theme_supports( 'popup-navigation' ) ) : ?>

			<nav class="tab-bar" data-topbar>
				<section class="left-small">
					<a class="left-off-canvas-toggle menu-icon" href="#off-canvas-navigation" role="button"><span></span></a>
				</section>
				<section class="middle tab-bar-section">
					<?php bloginfo( 'name' ); ?>
				</section>
			</nav>

			<?php endif; ?>

			<nav class="top-bar" data-topbar>

			<ul <?php hybrid_attr( 'branding' ); ?>>
			<?php if ( display_header_text() ) : // If user chooses to display header text. ?>

				<li class="name"><?php hybrid_site_title(); ?></li>
				<li class="description"><?php hybrid_site_description(); ?></li>

			<?php elseif ( get_header_image() && !display_header_text() ) : // If there's a header image but no header text. ?>

				<li class="name"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a></li>

			<?php elseif ( get_header_image() ) : // If there's a header image. ?>

				<li class="name"><img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></li>

			<?php endif; // End check for header image. ?>

			</ul><!-- #branding -->

			<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

			</nav>

			<?php if ( current_theme_supports( 'popup-navigation' ) ) : ?>

			<a class="popup-navigation-trigger" href="#">Menu</a>

			<?php endif; ?>

		</header><!-- #header -->

		<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

		<div id="main" class="main">

			<div class="wrap">

			<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
