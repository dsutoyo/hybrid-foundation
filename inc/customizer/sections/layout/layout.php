<?php
/**
 * Layout Options.
 *
 * @package     Hybrid Foundation
 * @since       4.0.0
 */

/*
 * =============================
 * Panel: Layout
 * ============================= 
 */
$wp_customize->add_panel(
	'panel_layout',
	array(
		'title' => __( 'Layout', 'hybrid-foundation' ),
		'priority' => 30,
	)
);

/*
 * =============================
 * Section: Containers
 * ============================= 
 */
$wp_customize->add_section(
	'panel_layout_section_containers',
	array(
		'title' => __( 'Containers', 'hybrid-foundation' ),
		'panel' => 'panel_layout',
	)
);

/*
 * Setting: Body Container Layout
 */
$wp_customize->add_setting(
	'layout_container',
	array(
		'capability' => 'edit_theme_options',
		//'sanitize_callback' => 'hybrid_foundation_sanitize_select',
		'default' => hybrid_foundation_get_option( 'layout_container' ),
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'layout_container',
	array(
		'type' => 'select',
		'section' => 'panel_layout_section_containers',
		'label' => __( 'Body Container Layout', 'hybrid-foundation' ),
		'choices' => array(
			'boxed' => __( 'Boxed', 'hybrid-foundation' ),
			'contained' => __( 'Contained', 'hybrid-foundation' ),
			'full-width' => __( 'Full Width', 'hybrid-foundation' ),
		),
	)
);

/*
 * Setting: Divider
 */
$wp_customize->add_setting(
	'layout_divider_1',
	array()
);

$wp_customize->add_control(
	new Hybrid_Foundation_Divider(
		$wp_customize,
		'layout_divider_1',
		array(
			'type' => 'hf-divider',
			'section' => 'panel_layout_section_containers',
			'label' => __( 'Body Container Layout', 'hybrid-foundation' ),
		)
	)
);

/*
 * Setting: Header Container Layout
 */
$wp_customize->add_setting(
	'layout_container_header',
	array(
		'capability' => 'edit_theme_options',
		//'sanitize_callback' => 'hybrid_foundation_sanitize_select',
		'default' => hybrid_foundation_get_option( 'layout_container_header' ),
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'layout_container_header',
	array(
		'type' => 'select',
		'section' => 'panel_layout_section_containers',
		'label' => __( 'Header Container Layout', 'hybrid-foundation' ),
		'choices' => array(
			'boxed' => __( 'Boxed', 'hybrid-foundation' ),
			'contained' => __( 'Contained', 'hybrid-foundation' ),
			'full-width' => __( 'Full Width', 'hybrid-foundation' ),
		),
	)
);

/*
 * Setting: Footer Container Layout
 */
$wp_customize->add_setting(
	'layout_container_footer',
	array(
		'capability' => 'edit_theme_options',
		//'sanitize_callback' => 'hybrid_foundation_sanitize_select',
		'default' => hybrid_foundation_get_option( 'layout_container_footer' ),
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'layout_container_footer',
	array(
		'type' => 'select',
		'section' => 'panel_layout_section_containers',
		'label' => __( 'Footer Container Layout', 'hybrid-foundation' ),
		'choices' => array(
			'boxed' => __( 'Boxed', 'hybrid-foundation' ),
			'contained' => __( 'Contained', 'hybrid-foundation' ),
			'full-width' => __( 'Full Width', 'hybrid-foundation' ),
		),
	)
);

/*
 * Setting: Divider
 */
$wp_customize->add_setting(
	'layout_divider_2',
	array()
);

$wp_customize->add_control(
	new Hybrid_Foundation_Divider(
		$wp_customize,
		'layout_divider_2',
		array(
			'type' => 'hf-divider',
			'section' => 'panel_layout_section_containers',
			'label' => __( 'Body Container Layout', 'hybrid-foundation' ),
		)
	)
);


/*
 * Setting: Page Container Layout
 */
$wp_customize->add_setting(
	'layout_container_page',
	array(
		'capability' => 'edit_theme_options',
		//'sanitize_callback' => 'hybrid_foundation_sanitize_select',
		'default' => hybrid_foundation_get_option( 'layout_container_page' ),
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'layout_container_page',
	array(
		'type' => 'select',
		'section' => 'panel_layout_section_containers',
		'label' => __( 'Page Body Container Layout', 'hybrid-foundation' ),
		'choices' => array(
			'default' => __( 'Default', 'hybrid-foundation' ),
			'boxed' => __( 'Boxed', 'hybrid-foundation' ),
			'contained' => __( 'Contained', 'hybrid-foundation' ),
			'full-width' => __( 'Full Width', 'hybrid-foundation' ),
		),
	)
);

$wp_customize->add_setting(
	'layout_container_post',
	array(
		'capability' => 'edit_theme_options',
		//'sanitize_callback' => 'hybrid_foundation_sanitize_select',
		'default' => hybrid_foundation_get_option( 'layout_container_post' ),
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'layout_container_post',
	array(
		'type' => 'select',
		'section' => 'panel_layout_section_containers',
		'label' => __( 'Blog Post Body Container Layout' ),
		'choices' => array(
			'default' => __( 'Default' ),
			'boxed' => __( 'Boxed' ),
			'contained' => __( 'Contained' ),
			'full-width' => __( 'Full Width' ),
		),
	)
);

$wp_customize->add_setting(
	'layout_container_archive',
	array(
		'capability' => 'edit_theme_options',
		//'sanitize_callback' => 'hybrid_foundation_sanitize_select',
		'default' => hybrid_foundation_get_option( 'layout_container_archive' ),
		'transport' => 'postMessage'
	)
);

$wp_customize->add_control(
	'layout_container_archive',
	array(
		'type' => 'select',
		'section' => 'panel_layout_section_containers',
		'label' => __( 'Blog Archive Body Container Layout' ),
		'choices' => array(
			'default' => __( 'Default' ),
			'boxed' => __( 'Boxed' ),
			'contained' => __( 'Contained' ),
			'full-width' => __( 'Full Width' ),
		),
	)
);

/*
 * =============================
 * Section: Content
 * ============================= 
 */
$wp_customize->add_section(
	'panel_layout_section_content',
	array(
		'title' => __( 'Content', 'hybrid-foundation' ),
		'panel' => 'panel_layout',
	)
);

/*
 * Setting: Page Content Layout
 */
$wp_customize->add_setting(
	'layout_content_page',
	array(
		'default'           => hybrid_foundation_get_option( 'layout_content_page' ),
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	new Hybrid_Customize_Control_Layout(
		$wp_customize,
		'layout_content_page',
		array(
			'label' => __( 'Page Content Layout', 'hybrid-foundation' ),
			'section' => 'panel_layout_section_content'
		)
	)
);

/*
 * Setting: Post Content Layout
 */
$wp_customize->add_setting(
	'layout_content_post',
	array(
		'default'           => hybrid_foundation_get_option( 'layout_content_post' ),
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	new Hybrid_Customize_Control_Layout(
		$wp_customize,
		'layout_content_post',
		array(
			'label' => __( 'Blog Post Content Layout', 'hybrid-foundation' ),
			'section' => 'panel_layout_section_content'
		)
	)
);

/*
 * Setting: Blog Archive Content Layout
 */
$wp_customize->add_setting(
	'layout_content_archive',
	array(
		'default'           => hybrid_foundation_get_option( 'layout_content_archive' ),
		'sanitize_callback' => 'sanitize_key',
		'transport'         => 'postMessage'
	)
);

$wp_customize->add_control(
	new Hybrid_Customize_Control_Layout(
		$wp_customize,
		'layout_content_archive',
		array(
			'label' => __( 'Blog Archive Content Layout', 'hybrid-foundation' ),
			'section' => 'panel_layout_section_content'
		)
	)
);