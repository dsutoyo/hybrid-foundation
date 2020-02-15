<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head <?php hybrid_attr( 'head' ); ?>>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

<div id="container" class="off-canvas-wrapper">

	<div class="off-canvas position-left" id="offCanvas" data-off-canvas data-transition="<?php echo current_theme_supports( 'offcanvas-overlap' ) ? 'overlap' : 'push' ?>">
		<?php hybrid_get_menu( 'mobile' ); ?>
	</div>

	<div class="off-canvas-content" data-off-canvas-content>

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'hybrid-base' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

			<nav class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
				<button type="button" class="menu-icon" data-toggle="offCanvas"></button>
				<div class="title-bar-title">
					<?php bloginfo( 'name' ); ?>
				</div>
			</nav>

			<div class="top-bar show-for-medium" data-topbar>

				<div class="top-bar-title <?php echo has_custom_logo() ? 'has-image' : 'has-text'; ?>">
					<ul <?php hybrid_attr( 'branding' ); ?>>
						<li class="name"><?php hybrid_site_title(); ?></li>
						<li class="description"><?php hybrid_site_description(); ?></li>
					</ul><!-- #branding -->
				</div>

				<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

			</div>

		</header><!-- #header -->

		<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

		<div id="main" class="main">

			<div class="main-wrap">

			<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
