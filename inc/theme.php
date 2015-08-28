<?php

# Register custom image sizes.
add_action( 'init', 'hybrid_base_register_image_sizes', 5 );

# Register custom menus.
add_action( 'init', 'hybrid_base_register_menus', 5 );

# Register custom layouts.
add_action( 'hybrid_register_layouts', 'hybrid_base_register_layouts' );

# Register sidebars.
add_action( 'widgets_init', 'hybrid_base_register_sidebars', 5 );

# Add custom scripts and styles
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_scripts', 5 );
add_action( 'wp_enqueue_scripts', 'hybrid_base_enqueue_styles', 5 );

# Add a class to the body
add_filter( 'hybrid_attr_body', 'hybrid_base_attr_body', 6 );

# Add a class to the branding
add_filter( 'hybrid_attr_branding', 'hybrid_base_attr_branding', 6 );

# Filter the theme layout class
add_filter( 'theme_mod_theme_layout', 'hybrid_base_theme_layout', 5 );

# Filter the default form options
add_filter( 'comment_form_defaults', 'hybrid_base_comment_form_defaults' );

/**
 * Registers custom image sizes for the theme. 
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	//set_post_thumbnail_size( 150, 150, true );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_menus() {
	register_nav_menu( 'primary',    esc_html_x( 'Primary',    'nav menu location', 'hybrid-base' ) );
	register_nav_menu( 'secondary',  esc_html_x( 'Secondary',  'nav menu location', 'hybrid-base' ) );
	register_nav_menu( 'subsidiary', esc_html_x( 'Subsidiary', 'nav menu location', 'hybrid-base' ) );
}

/**
 * Registers layouts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_layouts() {

	hybrid_register_layout( '1c',   array( 'label' => esc_html__( '1 Column',                     'hybrid-base' ), 'image' => '%s/assets/images/layouts/1c.png'   ) );
	hybrid_register_layout( '2c-l', array( 'label' => esc_html__( '2 Columns: Content / Sidebar', 'hybrid-base' ), 'image' => '%s/assets/images/layouts/2c-l.png' ) );
	hybrid_register_layout( '2c-r', array( 'label' => esc_html__( '2 Columns: Sidebar / Content', 'hybrid-base' ), 'image' => '%s/assets/images/layouts/2c-r.png' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => esc_html_x( 'Primary', 'sidebar', 'hybrid-base' ),
			'description' => esc_html__( 'Add sidebar description.', 'hybrid-base' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'          => 'subsidiary',
			'name'        => esc_html_x( 'Subsidiary', 'sidebar', 'hybrid-base' ),
			'description' => esc_html__( 'Add sidebar description.', 'hybrid-base' )
		)
	);
}

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_scripts() {
	global $_wp_theme_features;

	// ===== Foundation
	if ( current_theme_supports( 'foundation' ) ) {
		wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/assets/vendor/foundation/js/vendor/modernizr.js', 'jquery', '2.8.3', true );
		wp_enqueue_script( 'foundation', get_stylesheet_directory_uri() . '/assets/vendor/foundation/js/foundation.js', 'jquery', FOUNDATION_VERSION, true );
	}

	// ===== Load Foundation components if supported by the theme
	$foundation_components = array(
		'abide', 'accordion', 'alert', 'clearing', 'dropdown', 'equalizer', 'interchange', 'joyride', 'magellan', 'offcanvas', 'orbit', 'reveal', 'slider', 'tab', 'tooltip', 'topbar'
	);

	foreach ( $foundation_components as $component ) {	
		if ( current_theme_supports( 'foundation' ) && in_array( $component, $_wp_theme_features['foundation'][0] ) ) {
			if ( !current_theme_supports( 'popup-navigation' ) && $component == 'offcanvas' ) {
				wp_enqueue_script( 'foundation-' . $component, get_stylesheet_directory_uri() . '/assets/vendor/foundation/js/foundation/foundation.' . $component . '.js', array( 'jquery' ), FOUNDATION_VERSION, true );
			}
		}
	}

	// ===== Initialize Foundation
	if ( current_theme_supports( 'foundation' ) ) {
		wp_enqueue_script( 'foundation-init', get_stylesheet_directory_uri() . '/assets/javascripts/foundation.init.js', array( 'jquery' ), FOUNDATION_VERSION, true );
	}
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function hybrid_base_enqueue_styles() {

	/* Gets ".min" suffix. */
	$suffix = hybrid_get_min_suffix();

	/* Load one-five base style. */
	// wp_enqueue_style( 'one-five', trailingslashit( HYBRID_CSS ) . "one-five{$suffix}.css" );

	/* Load gallery style if 'cleaner-gallery' is active. */
	if ( current_theme_supports( 'cleaner-gallery' ) ) {
		wp_enqueue_style( 'gallery', trailingslashit( HYBRID_CSS ) . "gallery{$suffix}.css" );
	}

	/* Load parent theme stylesheet if child theme is active. */
	if ( is_child_theme() ) {
		wp_enqueue_style( 'parent', trailingslashit( get_template_directory_uri() ) . "style{$suffix}.css" );
	}

	/* Load active theme stylesheet. */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

/**
 * Filter the body attributes.
 *
 * @since  1.1.0
 * @access public
 * @return array
 */
function hybrid_base_attr_body( $attr ) {
	if ( current_theme_supports( 'popup-navigation' ) ) {
		$attr['class'] .= ' popup-navigation';
	}

	else {
		$attr['class'] .= ' offcanvas-navigation';
	}
	return $attr;
}

/**
 * Filter the branding attributes.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function hybrid_base_attr_branding( $attr ) {
	$attr['class'] = 'title-area';
	return $attr;
}

/**
 * Filters the default theme layout. Metaboxes options should still be able
 * to override these.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function hybrid_base_theme_layout( $theme_layout ) {

	/* If viewing a singular post, get the post layout. */
	if ( is_singular() )
		$layout = hybrid_get_post_layout( get_queried_object_id() );

	/* If viewing an author archive, get the user layout. */
	elseif ( is_author() )
		$layout = hybrid_get_user_layout( get_queried_object_id() );

	/* If a layout was found, set it. */
	if ( !empty( $layout ) && 'default' !== $layout ) {
		$theme_layout = $layout;
	}

	else {
		if ( is_front_page() ) {
			$theme_layout = '1c';
		}

		elseif ( is_page_template( 'template-builder.php' ) ) {
			$theme_layout = '1c';
		}

		else {
			$theme_layout = hybrid_get_default_layout();
		}
	}

	return $theme_layout;
}

/**
 * Filters the default comment form options.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function hybrid_base_comment_form_defaults( $defaults ) {
	
	/* Change the defaults depending on your requirements */
	//$defaults['title_reply'] = __( 'Submit a Comment', 'hybrid-base' );

	return $defaults;
}

/**
 * Callback function for adding editor styles.  Use along with the add_editor_style() function.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function hybrid_base_get_editor_styles() {

	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'assets/stylesheets/editor-style.css';

	/* If a child theme, add its editor styles. Note: WP checks whether the file exists before using it. */
	if ( is_child_theme() && file_exists( trailingslashit( get_stylesheet_directory() ) . 'css/editor-style.css' ) )
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'css/editor-style.css';

	/* Add the locale stylesheet. */
	$editor_styles[] = get_locale_stylesheet_uri();

	/* Uses Ajax to display custom theme styles added via the Theme Mods API. */
	$editor_styles[] = add_query_arg( 'action', 'hybrid_base_editor_styles', admin_url( 'admin-ajax.php' ) );

	/* Return the styles. */
	return $editor_styles;
}
