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

$wp_customize->add_setting( 'custom_logo_height' , array(
	'default' => 70,
) );

$wp_customize->add_control( 'custom_logo_height', array(
		'type'           => 'number',
		'section'        => 'title_tagline',
		'priority'       => 8,
		'label'          => __( 'Logo Height', 'hybrid-foundation' ),
		'description' => __( 'This is a custom number.' ),
	)
);