<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function grandview_create_customizer_options() {

	$titan = TitanFramework::getInstance( 'grandview' );

	// Theme defaults
	$primary_color = '#008CBA';
	$secondary_color = '#e7e7e7';
	$chrome_color = '#ccc';

	$primary_hover_color = '#007095';

	$primary_font = 'Open Sans';
	$secondary_font = 'Raleway';

	$section_site = $titan->createThemeCustomizerSection( array(
		'id' => 'title_tagline',
		'name' => __( 'Site Identity', 'grandview' ),
		'position' => 30,
	) );

	$section_site->createOption( array(
		'id' => 'logo',
		'name'   => __( 'Logo', 'grandview' ),
		'type'    => 'upload',
		'desc' => __( 'Your site logo. Upload an image that is <strong>double</strong> your desired size. Recommended size is 320 x 70.', 'grandview' )
	) );

	$section_site->createOption( array(
		'id' => 'logo-light',
		'name'   => __( 'Logo, Light Version', 'grandview' ),
		'type'    => 'upload',
		'desc' => __( 'The light version of your site logo, used when overlaying over banners. Keep it the same size as the regular logo.', 'grandview' )
	) );

	// Colors
	$section_colors = $titan->createThemeCustomizerSection( array(
		'id' => 'colors',
		'name' => __( 'Colors', 'grandview' ),
		'position' => 40
	) );

	$section_colors->createOption( array(
		'id' => 'primary-color',
		'name'   => __( 'Primary Color', 'grandview' ),
		'type'    => 'color',
		'default' => $primary_color,
		'css' => '
			.top-bar-section .dropdown li:not(.has-form):not(.active):hover > a:not(.button),
			#header.overlay .top-bar-section .dropdown li:not(.has-form):not(.active):hover > a:not(.button),
			.trail-items li a,
			a {
				color: value;
			}

			input[type="submit"],
			.more-link {
				background-color: value;
			}

			input[type="submit"] {
				border-color: value;
			}
		'
	) );

	$section_colors->createOption( array(
		'id' => 'primary-hover-color',
		'name'   => __( 'Primary Hover Color', 'grandview' ),
		'type'    => 'color',
		'default' => $primary_hover_color,
		'css' => '
			.top-bar-section .dropdown li:not(.has-form):not(.active):hover > a:not(.button),
			#header.overlay .top-bar-section .dropdown li:not(.has-form):not(.active):hover > a:not(.button),
			.top-bar-section ul li:hover:not(.has-form) > a,
			.trail-items li a:hover,
			a:hover {
				color: value;
			}

			input[type="submit"]:hover,
			input[type="submit"]:focus {
				background-color: value;
			}

			input[type="submit"]:hover,
			input[type="submit"]:focus {
				border-color: value;
			}
		'
	) );

	// Typography
	$section_type = $titan->createThemeCustomizerSection( array(
		'id' => 'typography',
		'name' => __( 'Typography', 'grandview' ),
	) );

	$section_type->createOption( array(
		'id' => 'primary-font',
		'name'   => __( 'Primary Font', 'grandview' ),
		'type'    => 'font',
		'show_google_fonts' => true,
		//'default' => $primary_font
	) );

	$section_type->createOption( array(
		'id' => 'secondary-font',
		'name'   => __( 'Secondary Font', 'grandview' ),
		'type'    => 'font',
		'show_google_fonts' => true,
		//'default' => $secondary_font
	) );

	// Featured Images
	$section_featured_images = $titan->createThemeCustomizerSection( array(
		'id' => 'featured-images',
		'name' => __( 'Featured Images', 'grandview' ),
		'position' => 60,
		'desc' => __( 'Options for the featured image in posts and pages. Does <strong>NOT</strong> affect the home page slider.', 'grandview' )
	) );

	$section_featured_images->createOption( array(
		'id' => 'featured-image-size',
		'name'   => __( 'Featured Image Size', 'grandview' ),
		'type'    => 'select',
		'options' => array(
			'cropped' => 'Cropped to fit content',
			'expanded' => 'Expanded to fit image'
		),
		'default' => 'cropped',
		'desc' => __( 'Your featured image will show in the header banner. Choose whether it will be cropped to fit the content, or expanded to fit the image ratio.', 'grandview' )
	) );

	$section_featured_images->createOption( array(
		'id' => 'featured-image-animation',
		'name'   => __( 'Animation', 'grandview' ),
		'type'    => 'select',
		'options' => array(
			'fade-in' => 'Fade In',
			'slide-up' => 'Slide Up',
			'slide-down' => 'Slide Down',
			'slide-left' => 'Slide Left',
			'slide-right' => 'Slide Right',
		),
		'default' => 'fade-in',
		'desc' => __( 'The entrance effect of the title over the featured image.', 'grandview' )
	) );

	$section_featured_images->createOption( array(
		'id' => 'featured-image-text-align',
		'name'   => __( 'Text Alignment', 'grandview' ),
		'type'    => 'select',
		'options' => array(
			'center' => 'Center',
			'left' => 'Left',
			'right' => 'Right'
		),
		'default' => 'center',
		'desc' => __( 'Text alignment of the title over the featured image.', 'grandview' )
	) );

	$section_featured_images->createOption( array(
		'id' => 'featured-image-overlay-color',
		'name'   => __( 'Overlay Color', 'grandview' ),
		'type'    => 'color',
		'desc' => __( 'A color overlay over your featured image to make the text pop.', 'grandview' )
	) );

	$section_featured_images->createOption( array(
		'id' => 'featured-image-overlay-opacity',
		'name' => __( 'Overlay Opacity', 'grandview' ),
		'type' => 'number',
		'min' => 0,
		'max' => 100,
		'desc' => __( 'The opacity of the color overlay. Enter 0-100.', 'grandview' )
	) );

	$section_featured_images->createOption( array(
		'id' => 'featured-text-background-color',
		'name' => __( 'Text Background Color', 'grandview' ),
		'type' => 'color',
		'desc' => __( 'A colored box behind your text to help make it pop.', 'grandview' )
	) );

	$section_featured_images->createOption( array(
		'id' => 'featured-text-background-opacity',
		'name'   => __( 'Text Background Opacity', 'grandview' ),
		'type' => 'number',
		'min' => 0,
		'max' => 100,
		'desc' => __( 'The opacity of the colored box. Enter 0-100.', 'grandview' )
	) );

	// Social
	$section_social = $titan->createThemeCustomizerSection( array(
		'id' => 'social',
		'name' => __( 'Social', 'grandview' ),
		'position' => 90
	) );

	$section_social->createOption( array(
		'id' => 'twitter',
		'name'   => __( 'Twitter URL', 'grandview' ),
		'type'    => 'text',
	) );

	$section_social->createOption( array(
		'id' => 'facebook',
		'name'   => __( 'Facebook URL', 'grandview' ),
		'section' => $section,
		'type'    => 'text',
	) );

	$section_social->createOption( array(
		'id' => 'instagram',
		'name'   => __( 'Instagram URL', 'grandview' ),
		'section' => $section,
		'type'    => 'text',
	) );

	$section_social->createOption( array(
		'id' => 'pinterest',
		'name'   => __( 'Pinterest URL', 'grandview' ),
		'section' => $section,
		'type'    => 'text',
	) );

	$section_social->createOption( array(
		'id' => 'yelp',
		'name'   => __( 'Yelp URL', 'grandview' ),
		'section' => $section,
		'type'    => 'text',
	) );

	// Footer
	$section_footer = $titan->createThemeCustomizerSection( array(
		'id' => 'footer',
		'name' => __( 'Footer', 'grandview' ),
		'position' => 100
	) );

	$section_footer->createOption( array(
		'id' => 'copyright',
		'name'   => __( 'Copyright Text', 'grandview' ),
		'type'    => 'textarea',
	) );

}
add_action( 'tf_create_options', 'grandview_create_customizer_options' );

function grandview_create_metabox_options() {


$test = array();
// The Query
$the_query = new WP_Query( array( 'post_type' => 'page' ) );

// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$test[get_the_ID()] = get_the_title();
	}
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();


	$titan = TitanFramework::getInstance( 'grandview' );

	$pageMetaBox = $titan->createMetaBox( array(
		'name' => 'Additional Page Options',
		'post_type' => 'page'
	) );

	$pageMetaBox ->createOption( array(
		'name' => 'My Sortable Option',
		'id' => 'my_sortable_option',
		'type' => 'sortable',
		'desc' => 'This is our option',
		'options' => $test
	) );
}
add_action( 'tf_create_options', 'grandview_create_metabox_options' );

?>
