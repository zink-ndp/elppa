<?php
$wp_customize->add_section(
	'layout_options',
	array(
		'title'    => esc_html__( 'Layout Options', 'beetan' ),
		'priority' => 30,
	)
);

// Site container width
$wp_customize->add_setting(
	'site_container_width',
	array(
		'default'           => beetan_default_option( 'site_container_width' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			$value = absint( $value );

			if ( $value > 1920 ) {
				$value = 1920;
			} else if ( $value < 768 ) {
				$value = 768;
			}

			return $value;
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'site_container_width',
		array(
			'label'       => esc_html__( 'Site Container Width', 'beetan' ),
			'section'     => 'layout_options',
			'input_attrs' => array(
				'min'    => 768,
				'max'    => 1920,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* Box layout inner padding */
$wp_customize->add_setting(
	'box_layout_inner_gap',
	array(
		'default'           => beetan_default_option( 'box_layout_inner_gap' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'box_layout_inner_gap',
		array(
			'label'           => esc_html__( 'Box Layout Inner Gap', 'beetan' ),
			'section'         => 'layout_options',
			'input_attrs'     => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			),
			'active_callback' => function () {
				if ( ( get_theme_mod( 'default_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'page_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'post_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'archive_post_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'archive_product_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'product_container_layout' ) === 'box' ) ) {
					return true;
				}

				return false;
			},
		)
	)
);

// Box layout background color
$wp_customize->add_setting(
	'box_layout_background_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'box_layout_background_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Alpha_Color_Control( $wp_customize,
		'box_layout_background_color',
		array(
			'label'           => esc_html__( 'Box Layout Background Color', 'beetan' ),
			'section'         => 'layout_options',
			'active_callback' => function () {
				if ( ( get_theme_mod( 'default_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'page_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'post_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'archive_post_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'archive_product_container_layout' ) === 'box' )
				     || ( get_theme_mod( 'product_container_layout' ) === 'box' ) ) {
					return true;
				}

				return false;
			},
		)
	)
);

// Site container Default layout
$wp_customize->add_setting(
	'default_container_layout',
	array(
		'default'           => beetan_default_option( 'default_container_layout' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'default_container_layout',
		array(
			'label'   => __( 'Default Layout', 'beetan' ),
			'section' => 'layout_options',
			'type'    => 'select',
			'choices' => array(
				'box'       => __( 'Box', 'beetan' ),
				'contained' => __( 'Full Width - Contained', 'beetan' ),
				'stretched' => __( 'Full Width - Stretched', 'beetan' ),
			),
		)
	)
);

// Page container layout
$wp_customize->add_setting(
	'page_container_layout',
	array(
		'default'           => beetan_default_option( 'page_container_layout' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'page_container_layout',
		array(
			'label'   => __( 'Page Layout', 'beetan' ),
			'section' => 'layout_options',
			'type'    => 'select',
			'choices' => array(
				''          => __( 'Default', 'beetan' ),
				'box'       => __( 'Box', 'beetan' ),
				'contained' => __( 'Full Width - Contained', 'beetan' ),
				'stretched' => __( 'Full Width - Stretched', 'beetan' ),
			),
		)
	)
);

// Single Post container layout
$wp_customize->add_setting(
	'post_container_layout',
	array(
		'default'           => beetan_default_option( 'post_container_layout' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'post_container_layout',
		array(
			'label'   => __( 'Single Post Layout', 'beetan' ),
			'section' => 'layout_options',
			'type'    => 'select',
			'choices' => array(
				''          => __( 'Default', 'beetan' ),
				'box'       => __( 'Box', 'beetan' ),
				'contained' => __( 'Full Width - Contained', 'beetan' ),
				'stretched' => __( 'Full Width - Stretched', 'beetan' ),
			),
		)
	)
);

// Blog/Archive container layout
$wp_customize->add_setting(
	'archive_post_container_layout',
	array(
		'default'           => beetan_default_option( 'archive_post_container_layout' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'archive_post_container_layout',
		array(
			'label'   => __( 'Blog Archive Layout', 'beetan' ),
			'section' => 'layout_options',
			'type'    => 'select',
			'choices' => array(
				''          => __( 'Default', 'beetan' ),
				'box'       => __( 'Box', 'beetan' ),
				'contained' => __( 'Full Width - Contained', 'beetan' ),
				'stretched' => __( 'Full Width - Stretched', 'beetan' ),
			),
		)
	)
);

if ( beetan_is_woocommerce_active() ) {
	// Shop container layout
	$wp_customize->add_setting(
		'archive_product_container_layout',
		array(
			'default'           => beetan_default_option( 'archive_product_container_layout' ),
			'sanitize_callback' => 'beetan_sanitize_select',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'archive_product_container_layout',
			array(
				'label'   => __( 'Shop Layout', 'beetan' ),
				'section' => 'layout_options',
				'type'    => 'select',
				'choices' => array(
					''          => __( 'Default', 'beetan' ),
					'box'       => __( 'Box', 'beetan' ),
					'contained' => __( 'Full Width - Contained', 'beetan' ),
					'stretched' => __( 'Full Width - Stretched', 'beetan' ),
				),
			)
		)
	);

	// Blog/Archive container layout
	$wp_customize->add_setting(
		'product_container_layout',
		array(
			'default'           => beetan_default_option( 'product_container_layout' ),
			'sanitize_callback' => 'beetan_sanitize_select',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'product_container_layout',
			array(
				'label'   => __( 'Single Product Layout', 'beetan' ),
				'section' => 'layout_options',
				'type'    => 'select',
				'choices' => array(
					''          => __( 'Default', 'beetan' ),
					'box'       => __( 'Box', 'beetan' ),
					'contained' => __( 'Full Width - Contained', 'beetan' ),
					'stretched' => __( 'Full Width - Stretched', 'beetan' ),
				),
			)
		)
	);
}