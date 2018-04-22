<?php
/**
 * Color Options.
 *
 * @package     Hybrid Foundation
 * @since       4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wp_customize->add_setting(
	'color_primary',
	array(
		'default' => hybrid_foundation_get_option( 'color_primary' )
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_primary',
		array(
			'label'    => esc_html__( 'Primary Color', 'hybrid-foundation' ),
			'section'  => 'colors',
			'settings' => 'color_primary',
			'priority' => 10,
		)
	)
);

$wp_customize->add_setting(
	'color_secondary',
	array(
		'default' => hybrid_foundation_get_option( 'color_secondary' )
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'color_secondary',
		array(
			'label'    => esc_html__( 'Secondary Color', 'hybrid-foundation' ),
			'section'  => 'colors',
			'settings' => 'color_secondary',
			'priority' => 10,
		)
	)
);