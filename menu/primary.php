<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<section class="menu-primary top-bar-left">

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul class="dropdown menu" data-dropdown-menu>%3$s</ul>'
			)
		); ?>

	</nav><!-- #menu-primary -->

	</section>

<?php endif; // End check for menu. ?>