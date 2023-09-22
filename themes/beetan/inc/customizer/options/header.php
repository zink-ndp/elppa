<?php
/*
* Start Header Settings
*/
$wp_customize->add_setting(
	'header_container',
	array(
		'default'           => beetan_default_option( 'header_container' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Buttons_Control( $wp_customize,
		'header_container',
		array(
			'label'    => esc_html__( 'Container Type', 'beetan' ),
			'section'  => 'header_options',
			'settings' => 'header_container',
			'choices'  => array(
				'container'       => esc_html__( 'Contained', 'beetan' ),
				'container-fluid' => esc_html__( 'Full-width', 'beetan' )
			)
		)
	)
);

$wp_customize->add_section(
	'header_options',
	array(
		'title'    => esc_html__( 'Header Options', 'beetan' ),
		'priority' => 30,
	)
);
$wp_customize->add_setting(
	'sticky_header',
	array(
		'default'           => beetan_default_option( 'sticky_header' ),
		'sanitize_callback' => 'beetan_sanitize_boolean',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'sticky_header',
		array(
			'label'   => esc_html__( 'Sticky Header', 'beetan' ),
			'section' => 'header_options',
		)
	)
);
$wp_customize->add_setting(
	'float_header',
	array(
		'default'           => beetan_default_option( 'float_header' ),
		'sanitize_callback' => 'beetan_sanitize_boolean',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'float_header',
		array(
			'label'   => esc_html__( 'Float Header', 'beetan' ),
			'section' => 'header_options',
		)
	)
);

// Site header color
$wp_customize->add_setting(
	"site_header_background_color",
	array(
		"default"           => maybe_hash_hex_color( beetan_default_option( 'site_header_background_color' ) ),
		"transport"         => "postMessage",
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Alpha_Color_Control( $wp_customize,
		'site_header_background_color',
		array(
			'label'   => esc_html__( 'Header Background Color', 'beetan' ),
			'section' => 'header_options',
		)
	)
);

// Site header box shadow color
$wp_customize->add_setting(
	"site_header_box_shadow",
	array(
		"default"           => maybe_hash_hex_color( beetan_default_option( 'site_header_box_shadow' ) ),
		"transport"         => "postMessage",
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Alpha_Color_Control( $wp_customize,
		'site_header_box_shadow',
		array(
			'label'   => esc_html__( 'Header Box Shadow Color', 'beetan' ),
			'section' => 'header_options',
		)
	)
);

/* Header Variation Control */
$wp_customize->add_setting(
	'header_variation',
	array(
		'default'           => beetan_default_option( 'header_variation' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'header_variation',
		array(
			'label'    => esc_html__( 'Header Styles', 'beetan' ),
			'section'  => 'header_options',
			'settings' => 'header_variation',
			'choices'  => array(
				'1' => array(
					'label' => esc_html__( 'Header Style 1', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/header-1.svg' )
				),
				'2' => array(
					'label' => esc_html__( 'Header Style 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/header-2.svg' )
				),
				'3' => array(
					'label' => esc_html__( 'Header Style 3', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/header-3.svg' )
				),
				'4' => array(
					'label' => esc_html__( 'Header Style 4', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/header-4.svg' )
				)
			)
		)
	)
);

// Show header Search icon
$wp_customize->add_setting(
	'enable_header_search',
	array(
		'default'           => beetan_default_option( 'enable_header_search' ),
		'sanitize_callback' => 'beetan_sanitize_boolean',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_header_search',
		array(
			'label'   => esc_html__( 'Enable Search', 'beetan' ),
			'section' => 'header_options',
		)
	)
);

if ( beetan_is_woocommerce_active() ) {
	// Show header Mini Cart icon
	$wp_customize->add_setting(
		'enable_header_mini_cart',
		array(
			'default'           => beetan_default_option( 'enable_header_mini_cart' ),
			'sanitize_callback' => 'beetan_sanitize_boolean',
		)
	);
	$wp_customize->add_control(
		new Beetan_Customize_Toggle_Control( $wp_customize,
			'enable_header_mini_cart',
			array(
				'label'   => esc_html__( 'Enable Mini Cart', 'beetan' ),
				'section' => 'header_options',
			)
		)
	);
	
	// Show header My Account icon
	$wp_customize->add_setting(
		'enable_header_my_account',
		array(
			'default'           => beetan_default_option( 'enable_header_my_account' ),
			'sanitize_callback' => 'beetan_sanitize_boolean',
		)
	);
	$wp_customize->add_control(
		new Beetan_Customize_Toggle_Control( $wp_customize,
			'enable_header_my_account',
			array(
				'label'   => esc_html__( 'Enable My Account', 'beetan' ),
				'section' => 'header_options',
			)
		)
	);
}

new Beetan_Customize_Heading( $wp_customize,
	'header_options',
	esc_html__( 'Header Top', 'beetan' )
);

// Header Top Background color
$wp_customize->add_setting(
	'site_header_top_background_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'site_header_top_background_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'site_header_top_background_color',
		array(
			'label'   => esc_html__( 'Header Top Background Color', 'beetan' ),
			'section' => 'header_options',
		)
	)
);