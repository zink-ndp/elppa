<?php
$wp_customize->add_section(
	'footer_options',
	array(
		'title'    => esc_html__( 'Footer Options', 'beetan' ),
		'priority' => 32,
	)
);

// Add copyright text
$wp_customize->add_setting(
	'copyright_text',
	array(
		'default'           => beetan_default_option( 'copyright_text' ),
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_TinyMCE_Control( $wp_customize,
		'copyright_text',
		array(
			'label'   => esc_html__( 'Copyright Text', 'beetan' ),
			'section' => 'footer_options'
		)
	)
);

/* Add Back to top button */
new Beetan_Customize_Heading( $wp_customize,
	'footer_options',
	esc_html__( 'Back to Top Button', 'beetan' )
);

/* Enable Back to top button */
$wp_customize->add_setting(
	'enable_back_to_top_button',
	array(
		'default'           => beetan_default_option( 'enable_back_to_top_button' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_back_to_top_button',
		array(
			'label'    => esc_html__( 'Enable Back to Top Button', 'beetan' ),
			'section'  => 'footer_options',
			'settings' => 'enable_back_to_top_button',
		)
	)
);

/* Back to Top Button Icon */
$wp_customize->add_setting(
	'back_to_top_button_icon',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_icon' ),
		'sanitize_callback' => 'sanitize_key'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'back_to_top_button_icon',
		array(
			'label'   => esc_html__( 'Choose Icon', 'beetan' ),
			'section' => 'footer_options',
			'choices' => array(
				'arrow_upward'             => array(
					'label' => esc_html__( 'Icon 1', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/back-to-top-icons/icon-1.svg' )
				),
				'expand_less'              => array(
					'label' => esc_html__( 'Icon 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/back-to-top-icons/icon-2.svg' )
				),
				'arrow_drop_up'            => array(
					'label' => esc_html__( 'Icon 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/back-to-top-icons/icon-3.svg' )
				),
				'keyboard_double_arrow_up' => array(
					'label' => esc_html__( 'Icon 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/back-to-top-icons/icon-4.svg' )
				),
				'north'                    => array(
					'label' => esc_html__( 'Icon 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/back-to-top-icons/icon-5.svg' )
				),
				'straight'                 => array(
					'label' => esc_html__( 'Icon 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/back-to-top-icons/icon-6.svg' )
				),
				'swipe_up'                 => array(
					'label' => esc_html__( 'Icon 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/back-to-top-icons/icon-7.svg' )
				),
			)
		)
	)
);

/* Button background color */
$wp_customize->add_setting(
	'back_to_top_button_background_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'back_to_top_button_background_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'back_to_top_button_background_color',
		array(
			'label'   => esc_html__( 'Button Background Color', 'beetan' ),
			'section' => 'footer_options',
		)
	)
);

/* Button icon color */
$wp_customize->add_setting(
	'back_to_top_button_icon_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'back_to_top_button_icon_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( $wp_customize,
		'back_to_top_button_icon_color',
		array(
			'label'   => esc_html__( 'Button Icon Color', 'beetan' ),
			'section' => 'footer_options',
		)
	)
);

/* Back to Top button width */
$wp_customize->add_setting(
	'back_to_top_button_icon_size',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_icon_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'back_to_top_button_icon_size',
		array(
			'label'       => esc_html__( 'Icon Size', 'beetan' ),
			'section'     => 'footer_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* Back to Top button width */
$wp_customize->add_setting(
	'back_to_top_button_width',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_width' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'back_to_top_button_width',
		array(
			'label'       => esc_html__( 'Button Width', 'beetan' ),
			'section'     => 'footer_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* Back to Top button height */
$wp_customize->add_setting(
	'back_to_top_button_height',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'back_to_top_button_height',
		array(
			'label'       => esc_html__( 'Button Height', 'beetan' ),
			'section'     => 'footer_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* Back to Top Button border radius */
$wp_customize->add_setting(
	'back_to_top_button_radius',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_radius' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'back_to_top_button_radius',
		array(
			'label'       => esc_html__( 'Button Radius', 'beetan' ),
			'section'     => 'footer_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px',
			)
		)
	)
);

/* Back to Top Button position */
$wp_customize->add_setting(
	'back_to_top_button_position',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_position' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Buttons_Control( $wp_customize,
		'back_to_top_button_position',
		array(
			'label'    => esc_html__( 'Button Position', 'beetan' ),
			'section'  => 'footer_options',
			'settings' => 'back_to_top_button_position',
			'choices'  => array(
				'left'  => esc_html__( 'Left', 'beetan' ),
				'right' => esc_html__( 'Right', 'beetan' ),
			)
		)
	)
);

/* Back to Top Button bottom offset */
$wp_customize->add_setting(
	'back_to_top_button_bottom_offset',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_bottom_offset' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'back_to_top_button_bottom_offset',
		array(
			'label'       => esc_html__( 'Button Bottom Offset', 'beetan' ),
			'section'     => 'footer_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 200,
				'step'   => 1,
				'suffix' => 'px',
			)
		)
	)
);

/* Back to Top Button left/right offset */
$wp_customize->add_setting(
	'back_to_top_button_left_right_offset',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_left_right_offset' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'back_to_top_button_left_right_offset',
		array(
			'label'       => esc_html__( 'Button Left/Right Offset', 'beetan' ),
			'section'     => 'footer_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 200,
				'step'   => 1,
				'suffix' => 'px',
			)
		)
	)
);

/* Back to Top Button visibility */
$wp_customize->add_setting(
	'back_to_top_button_visibility',
	array(
		'default'           => beetan_default_option( 'back_to_top_button_visibility' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'back_to_top_button_visibility',
		array(
			'label'           => __( 'Button Visibility', 'beetan' ),
			'section'         => 'footer_options',
			'type'            => 'select',
			'choices'         => array(
				'all'          => __( 'Show on All Devices', 'beetan' ),
				'desktop-only' => __( 'Show on Desktop Only', 'beetan' ),
				'mobile-only'  => __( 'Show on Mobile/Tablet Only', 'beetan' ),
			),
		)
	)
);
