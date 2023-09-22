<?php
/*
* Start Color Settings
*/
$wp_customize->add_section(
	'color_options',
	array(
		'title'    => esc_html__( 'Color Options', 'beetan' ),
		'priority' => 32,
	)
);

// Theme color
$wp_customize->add_setting(
	'primary_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'primary_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'primary_color',
		array(
			'label'   => esc_html__( 'Primary Color', 'beetan' ),
			'section' => 'color_options',
		)
	)
);

// Site Background Color
$wp_customize->add_setting(
	'site_background_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'site_background_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'site_background_color',
		array(
			'label'   => esc_html__( 'Site Background Color', 'beetan' ),
			'section' => 'color_options',
		)
	)
);

// Body font color
$wp_customize->add_setting(
	'text_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'text_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'text_color',
		array(
			'label'   => esc_html__( 'Text Color', 'beetan' ),
			'section' => 'color_options',
		)
	)
);

// Heading font color
$wp_customize->add_setting(
	'heading_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'heading_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'heading_color',
		array(
			'label'   => esc_html__( 'Heading Color', 'beetan' ),
			'section' => 'color_options',
		)
	)
);

// Sub Heading font color
$wp_customize->add_setting(
	'sub_heading_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'sub_heading_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'sub_heading_color',
		array(
			'label'   => esc_html__( 'Sub Heading Color', 'beetan' ),
			'section' => 'color_options',
		)
	)
);

// Link color
$wp_customize->add_setting(
	'link_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'link_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'link_color',
		array(
			'label'   => esc_html__( 'Link Color', 'beetan' ),
			'section' => 'color_options',
		)
	)
);

// Link hover color
$wp_customize->add_setting(
	'link_hover_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'link_hover_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'link_hover_color',
		array(
			'label'   => esc_html__( 'Link Hover Color', 'beetan' ),
			'section' => 'color_options',
		)
	)
);
/*
* End Color Settings
*/