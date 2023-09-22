<?php
new Beetan_Customize_Heading( $wp_customize,
	'body_font_options',
	esc_html__( 'Body Font', 'beetan' )
);

$wp_customize->add_panel(
	'typography_options',
	array(
		'priority'   => 32,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Typography Options', 'beetan' ),
	)
);

/**
 * Body font settings
 */
$wp_customize->add_section(
	'body_font_options',
	array(
		'title' => esc_html__( 'Body Font', 'beetan' ),
		'panel' => 'typography_options',
	)
);

new Beetan_Customize_Typography(
	$wp_customize,
	'body_font',
	array(
		'label'   => esc_html__( 'Body Font', 'beetan' ),
		'default' => beetan_default_option( 'body_font' ),
		'section' => 'body_font_options',
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'body_font_options',
	esc_html__( 'Base', 'beetan' )
);

/* Base font size */
$wp_customize->add_setting(
	'base_font_size',
	array(
		'default'           => beetan_default_option( 'base_font_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'base_font_size',
		array(
			'label'       => esc_html__( 'Base Font Size', 'beetan' ),
			'section'     => 'body_font_options',
			'input_attrs' => array(
				'min'    => 12,
				'max'    => 50,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

// Base font weight
$wp_customize->add_setting(
	'base_font_weight',
	array(
		'default'           => beetan_default_option( 'base_font_weight' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'base_font_weight',
		array(
			'label'   => __( 'Base Font Weight', 'beetan' ),
			'section' => 'body_font_options',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light 300', 'beetan' ),
				'400' => __( 'Regular 400', 'beetan' ),
				'500' => __( 'Medium 500', 'beetan' ),
				'600' => __( 'Semi Bold 600', 'beetan' ),
				'700' => __( 'Bold 700', 'beetan' ),
				'800' => __( 'Extra Bold 800', 'beetan' ),
				'900' => __( 'Black 900', 'beetan' ),
			),
		)
	)
);

/* Base font line height */
$wp_customize->add_setting(
	'base_line_height',
	array(
		'default'           => beetan_default_option( 'base_line_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'base_line_height',
		array(
			'label'       => esc_html__( 'Base Font Line Height', 'beetan' ),
			'section'     => 'body_font_options',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 3,
				'step'   => 0.1,
				'suffix' => 'pt'
			)
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'body_font_options',
	esc_html__( 'Paragraph', 'beetan' )
);

/*
 * Paragraph top space
 */
$wp_customize->add_setting(
	'paragraph_margin_top',
	array(
		'default'           => beetan_default_option( 'paragraph_margin_top' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'paragraph_margin_top',
		array(
			'label'       => esc_html__( 'Margin Top', 'beetan' ),
			'section'     => 'body_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/*
 * Paragraph bottom space
 */
$wp_customize->add_setting(
	'paragraph_margin_bottom',
	array(
		'default'           => beetan_default_option( 'paragraph_margin_bottom' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'paragraph_margin_bottom',
		array(
			'label'       => esc_html__( 'Margin Bottom', 'beetan' ),
			'section'     => 'body_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);


/**
 * Heading font settings
 */
new Beetan_Customize_Heading( $wp_customize,
	'heading_font_options',
	esc_html__( 'Heading Font', 'beetan' )
);

$wp_customize->add_section(
	'heading_font_options',
	array(
		'title' => esc_html__( 'Heading Font', 'beetan' ),
		'panel' => 'typography_options',
	)
);

new Beetan_Customize_Typography(
	$wp_customize,
	'heading_font',
	array(
		'label'   => esc_html__( 'Heading Font', 'beetan' ),
		'default' => beetan_default_option( 'heading_font' ),
		'section' => 'heading_font_options',
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'heading_font_options',
	esc_html__( 'H1', 'beetan' )
);

/* H1 font Size */
$wp_customize->add_setting(
	'h1_font_size',
	array(
		'default'           => beetan_default_option( 'h1_font_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h1_font_size',
		array(
			'label'       => esc_html__( 'Font Size', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 12,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* H1 font weight */
$wp_customize->add_setting(
	'h1_font_weight',
	array(
		'default'           => beetan_default_option( 'h1_font_weight' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'h1_font_weight',
		array(
			'label'   => __( 'Font Weight', 'beetan' ),
			'section' => 'heading_font_options',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light 300', 'beetan' ),
				'400' => __( 'Regular 400', 'beetan' ),
				'500' => __( 'Medium 500', 'beetan' ),
				'600' => __( 'Semi Bold 600', 'beetan' ),
				'700' => __( 'Bold 700', 'beetan' ),
				'800' => __( 'Extra Bold 800', 'beetan' ),
				'900' => __( 'Black 900', 'beetan' ),
			),
		)
	)
);

/* H1 line height */
$wp_customize->add_setting(
	'h1_line_height',
	array(
		'default'           => beetan_default_option( 'h1_line_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h1_line_height',
		array(
			'label'       => esc_html__( 'Line Height', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 3,
				'step'   => 0.1,
				'suffix' => 'pt'
			)
		)
	)
);

/*
 * H1 top space
 */
$wp_customize->add_setting(
	'h1_margin_top',
	array(
		'default'           => beetan_default_option( 'h1_margin_top' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h1_margin_top',
		array(
			'label'       => esc_html__( 'Margin Top', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/*
 * H1 bottom space
 */
$wp_customize->add_setting(
	'h1_margin_bottom',
	array(
		'default'           => beetan_default_option( 'h1_margin_bottom' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h1_margin_bottom',
		array(
			'label'       => esc_html__( 'Margin Bottom', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'heading_font_options',
	esc_html__( 'H2', 'beetan' )
);

/* H2 font Size */
$wp_customize->add_setting(
	'h2_font_size',
	array(
		'default'           => beetan_default_option( 'h2_font_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h2_font_size',
		array(
			'label'       => esc_html__( 'Font Size', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 12,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* H2 font weight */
$wp_customize->add_setting(
	'h2_font_weight',
	array(
		'default'           => beetan_default_option( 'h2_font_weight' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'h2_font_weight',
		array(
			'label'   => __( 'Font Weight', 'beetan' ),
			'section' => 'heading_font_options',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light 300', 'beetan' ),
				'400' => __( 'Regular 400', 'beetan' ),
				'500' => __( 'Medium 500', 'beetan' ),
				'600' => __( 'Semi Bold 600', 'beetan' ),
				'700' => __( 'Bold 700', 'beetan' ),
				'800' => __( 'Extra Bold 800', 'beetan' ),
				'900' => __( 'Black 900', 'beetan' ),
			),
		)
	)
);

/* H2 line height */
$wp_customize->add_setting(
	'h2_line_height',
	array(
		'default'           => beetan_default_option( 'h2_line_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h2_line_height',
		array(
			'label'       => esc_html__( 'Line Height', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 3,
				'step'   => 0.1,
				'suffix' => 'pt'
			)
		)
	)
);

/*
 * H2 top space
 */
$wp_customize->add_setting(
	'h2_margin_top',
	array(
		'default'           => beetan_default_option( 'h2_margin_top' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h2_margin_top',
		array(
			'label'       => esc_html__( 'Margin Top', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/*
 * H2 bottom space
 */
$wp_customize->add_setting(
	'h2_margin_bottom',
	array(
		'default'           => beetan_default_option( 'h2_margin_bottom' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h2_margin_bottom',
		array(
			'label'       => esc_html__( 'Margin Bottom', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'heading_font_options',
	esc_html__( 'H3', 'beetan' )
);

/* H3 font Size */
$wp_customize->add_setting(
	'h3_font_size',
	array(
		'default'           => beetan_default_option( 'h3_font_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h3_font_size',
		array(
			'label'       => esc_html__( 'Font Size', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 12,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* H3 font weight */
$wp_customize->add_setting(
	'h3_font_weight',
	array(
		'default'           => beetan_default_option( 'h3_font_weight' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'h3_font_weight',
		array(
			'label'   => __( 'Font Weight', 'beetan' ),
			'section' => 'heading_font_options',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light 300', 'beetan' ),
				'400' => __( 'Regular 400', 'beetan' ),
				'500' => __( 'Medium 500', 'beetan' ),
				'600' => __( 'Semi Bold 600', 'beetan' ),
				'700' => __( 'Bold 700', 'beetan' ),
				'800' => __( 'Extra Bold 800', 'beetan' ),
				'900' => __( 'Black 900', 'beetan' ),
			),
		)
	)
);

/* H3 line height */
$wp_customize->add_setting(
	'h3_line_height',
	array(
		'default'           => beetan_default_option( 'h3_line_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h3_line_height',
		array(
			'label'       => esc_html__( 'Line Height', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 3,
				'step'   => 0.1,
				'suffix' => 'pt'
			)
		)
	)
);

/*
 * H3 top space
 */
$wp_customize->add_setting(
	'h3_margin_top',
	array(
		'default'           => beetan_default_option( 'h3_margin_top' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h3_margin_top',
		array(
			'label'       => esc_html__( 'Margin Top', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/*
 * H3 bottom space
 */
$wp_customize->add_setting(
	'h3_margin_bottom',
	array(
		'default'           => beetan_default_option( 'h3_margin_bottom' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h3_margin_bottom',
		array(
			'label'       => esc_html__( 'Margin Bottom', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'heading_font_options',
	esc_html__( 'H4', 'beetan' )
);

/* H4 font Size */
$wp_customize->add_setting(
	'h4_font_size',
	array(
		'default'           => beetan_default_option( 'h4_font_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h4_font_size',
		array(
			'label'       => esc_html__( 'Font Size', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 12,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* H4 font weight */
$wp_customize->add_setting(
	'h4_font_weight',
	array(
		'default'           => beetan_default_option( 'h4_font_weight' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'h4_font_weight',
		array(
			'label'   => __( 'Font Weight', 'beetan' ),
			'section' => 'heading_font_options',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light 300', 'beetan' ),
				'400' => __( 'Regular 400', 'beetan' ),
				'500' => __( 'Medium 500', 'beetan' ),
				'600' => __( 'Semi Bold 600', 'beetan' ),
				'700' => __( 'Bold 700', 'beetan' ),
				'800' => __( 'Extra Bold 800', 'beetan' ),
				'900' => __( 'Black 900', 'beetan' ),
			),
		)
	)
);

/* H4 line height */
$wp_customize->add_setting(
	'h4_line_height',
	array(
		'default'           => beetan_default_option( 'h4_line_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h4_line_height',
		array(
			'label'       => esc_html__( 'Line Height', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 3,
				'step'   => 0.1,
				'suffix' => 'pt'
			)
		)
	)
);

/*
 * H4 top space
 */
$wp_customize->add_setting(
	'h4_margin_top',
	array(
		'default'           => beetan_default_option( 'h4_margin_top' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h4_margin_top',
		array(
			'label'       => esc_html__( 'Margin Top', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/*
 * H4 bottom space
 */
$wp_customize->add_setting(
	'h4_margin_bottom',
	array(
		'default'           => beetan_default_option( 'h4_margin_bottom' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h4_margin_bottom',
		array(
			'label'       => esc_html__( 'Margin Bottom', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'heading_font_options',
	esc_html__( 'H5', 'beetan' )
);

/* H5 font Size */
$wp_customize->add_setting(
	'h5_font_size',
	array(
		'default'           => beetan_default_option( 'h5_font_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h5_font_size',
		array(
			'label'       => esc_html__( 'Font Size', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 12,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* H5 font weight */
$wp_customize->add_setting(
	'h5_font_weight',
	array(
		'default'           => beetan_default_option( 'h5_font_weight' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'h5_font_weight',
		array(
			'label'   => __( 'Font Weight', 'beetan' ),
			'section' => 'heading_font_options',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light 300', 'beetan' ),
				'400' => __( 'Regular 400', 'beetan' ),
				'500' => __( 'Medium 500', 'beetan' ),
				'600' => __( 'Semi Bold 600', 'beetan' ),
				'700' => __( 'Bold 700', 'beetan' ),
				'800' => __( 'Extra Bold 800', 'beetan' ),
				'900' => __( 'Black 900', 'beetan' ),
			),
		)
	)
);

/* H5 line height */
$wp_customize->add_setting(
	'h5_line_height',
	array(
		'default'           => beetan_default_option( 'h5_line_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h5_line_height',
		array(
			'label'       => esc_html__( 'Line Height', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 3,
				'step'   => 0.1,
				'suffix' => 'pt'
			)
		)
	)
);

/*
 * H5 top space
 */
$wp_customize->add_setting(
	'h5_margin_top',
	array(
		'default'           => beetan_default_option( 'h5_margin_top' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h5_margin_top',
		array(
			'label'       => esc_html__( 'Margin Top', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/*
 * H5 bottom space
 */
$wp_customize->add_setting(
	'h5_margin_bottom',
	array(
		'default'           => beetan_default_option( 'h5_margin_bottom' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h5_margin_bottom',
		array(
			'label'       => esc_html__( 'Margin Bottom', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'heading_font_options',
	esc_html__( 'H6', 'beetan' )
);

/* H6 font Size */
$wp_customize->add_setting(
	'h6_font_size',
	array(
		'default'           => beetan_default_option( 'h6_font_size' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h6_font_size',
		array(
			'label'       => esc_html__( 'Font Size', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 12,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* H6 font weight */
$wp_customize->add_setting(
	'h6_font_weight',
	array(
		'default'           => beetan_default_option( 'h6_font_weight' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'h6_font_weight',
		array(
			'label'   => __( 'Font Weight', 'beetan' ),
			'section' => 'heading_font_options',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light 300', 'beetan' ),
				'400' => __( 'Regular 400', 'beetan' ),
				'500' => __( 'Medium 500', 'beetan' ),
				'600' => __( 'Semi Bold 600', 'beetan' ),
				'700' => __( 'Bold 700', 'beetan' ),
				'800' => __( 'Extra Bold 800', 'beetan' ),
				'900' => __( 'Black 900', 'beetan' ),
			),
		)
	)
);

/* H6 line height */
$wp_customize->add_setting(
	'h6_line_height',
	array(
		'default'           => beetan_default_option( 'h6_line_height' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h6_line_height',
		array(
			'label'       => esc_html__( 'Line Height', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 1,
				'max'    => 3,
				'step'   => 0.1,
				'suffix' => 'pt'
			)
		)
	)
);

/*
 * H6 top space
 */
$wp_customize->add_setting(
	'h6_margin_top',
	array(
		'default'           => beetan_default_option( 'h6_margin_top' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h6_margin_top',
		array(
			'label'       => esc_html__( 'Margin Top', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/*
 * H6 bottom space
 */
$wp_customize->add_setting(
	'h6_margin_bottom',
	array(
		'default'           => beetan_default_option( 'h6_margin_bottom' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'h6_margin_bottom',
		array(
			'label'       => esc_html__( 'Margin Bottom', 'beetan' ),
			'section'     => 'heading_font_options',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);