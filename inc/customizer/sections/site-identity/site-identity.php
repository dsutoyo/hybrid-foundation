<?php
/**
 * Additional Site Identity Options.
 *
 * @package     Hybrid Foundation
 * @since       4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wp_customize->add_setting( 'site_logo' , array(
	'default' => get_theme_mod( 'site_logo' ),
	'type' => 'option',
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize, 'site_logo', array(
			'section'        => 'title_tagline',
			'priority'       => 20,
			'label'          => __( 'Logo', 'hybrid-foundation' ),
			'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png' ),
		)
	)
);