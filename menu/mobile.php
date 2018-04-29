<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<!-- Off Canvas Menu -->
	<aside class="left-off-canvas-menu off-canvas-menu">

		<?php if ( current_theme_supports( 'popup-navigation' ) ) : ?>

			<a class="popup-navigation-close" href="#">Close</a>

		<?php endif; ?>

		<?php wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'depth' => 0,
				'items_wrap' => '<ul class="vertical menu" data-accordion-menu>%3$s</ul>',
				'container' => false
			)
		);?>

	</aside>
 	<a class="exit-off-canvas"></a>

<?php endif; ?>