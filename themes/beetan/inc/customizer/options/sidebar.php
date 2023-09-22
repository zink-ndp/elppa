<?php
/*
* Start Sidebar Settings
*/
$wp_customize->add_section(
	'sidebar_settings_section',
	array(
		'title'    => esc_html__( 'Sidebar Options', 'beetan' ),
		'priority' => 30,
	)
);

/* Sidebar width */
$wp_customize->add_setting(
	'sidebar_width',
	array(
		'default'           => beetan_default_option( 'sidebar_width' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => function ( $value ) {
			$value = absint( $value );

			if ( $value > 50 ) {
				$value = 50;
			} elseif ( $value < 10 ) {
				$value = 10;
			}

			return $value;
		}
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'sidebar_width',
		array(
			'label'       => esc_html__( 'Sidebar Width', 'beetan' ),
			'section'     => 'sidebar_settings_section',
			'input_attrs' => array(
				'min'    => 10,
				'max'    => 50,
				'step'   => 1,
				'suffix' => '%'
			)
		)
	)
);

/* Page Sidebar Control */
$wp_customize->add_setting(
	'page_sidebar_position',
	array(
		'default'           => beetan_default_option( 'page_sidebar_position' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'page_sidebar_position',
		array(
			'label'    => esc_html__( 'Page', 'beetan' ),
			'section'  => 'sidebar_settings_section',
			'settings' => 'page_sidebar_position',
			'choices'  => array(
				'no_sidebar'    => array(
					'label' => esc_html__( 'No Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/full-width.svg' )
				),
				'left_sidebar'  => array(
					'label' => esc_html__( 'Left Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/left-sidebar.svg' )
				),
				'right_sidebar' => array(
					'label' => esc_html__( 'Right Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/right-sidebar.svg' )
				)
			)
		)
	)
);

/* Single Post Sidebar Control */
$wp_customize->add_setting(
	'post_sidebar_position',
	array(
		'default'           => beetan_default_option( 'post_sidebar_position' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'post_sidebar_position',
		array(
			'label'    => esc_html__( 'Single Post', 'beetan' ),
			'section'  => 'sidebar_settings_section',
			'settings' => 'post_sidebar_position',
			'choices'  => array(
				'no_sidebar'    => array(
					'label' => esc_html__( 'No Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/full-width.svg' )
				),
				'left_sidebar'  => array(
					'label' => esc_html__( 'Left Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/left-sidebar.svg' )
				),
				'right_sidebar' => array(
					'label' => esc_html__( 'Right Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/right-sidebar.svg' )
				)
			)
		)
	)
);

/* Archive Sidebar Control */
$wp_customize->add_setting(
	'archive_post_sidebar_position',
	array(
		'default'           => beetan_default_option( 'archive_post_sidebar_position' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'archive_post_sidebar_position',
		array(
			'label'    => esc_html__( 'Archives', 'beetan' ),
			'section'  => 'sidebar_settings_section',
			'settings' => 'archive_post_sidebar_position',
			'choices'  => array(
				'no_sidebar'    => array(
					'label' => esc_html__( 'No Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/full-width.svg' )
				),
				'left_sidebar'  => array(
					'label' => esc_html__( 'Left Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/left-sidebar.svg' )
				),
				'right_sidebar' => array(
					'label' => esc_html__( 'Right Sidebar', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/right-sidebar.svg' )
				)
			)
		)
	) );

if ( beetan_is_woocommerce_active() ) {
	/* WooCommerce Sidebar Control */
	$wp_customize->add_setting(
		'archive_product_sidebar_position',
		array(
			'default'           => beetan_default_option( 'archive_product_sidebar_position' ),
			'sanitize_callback' => 'beetan_sanitize_select',
		)
	);
	$wp_customize->add_control(
		new Beetan_Customize_Radio_Image_Control( $wp_customize,
			'archive_product_sidebar_position',
			array(
				'label'    => esc_html__( 'WooCommerce', 'beetan' ),
				'section'  => 'sidebar_settings_section',
				'settings' => 'archive_product_sidebar_position',
				'choices'  => array(
					'no_sidebar'    => array(
						'label' => esc_html__( 'No Sidebar', 'beetan' ),
						'url'   => get_theme_file_uri( '/assets/images/full-width.svg' )
					),
					'left_sidebar'  => array(
						'label' => esc_html__( 'Left Sidebar', 'beetan' ),
						'url'   => get_theme_file_uri( '/assets/images/left-sidebar.svg' )
					),
					'right_sidebar' => array(
						'label' => esc_html__( 'Right Sidebar', 'beetan' ),
						'url'   => get_theme_file_uri( '/assets/images/right-sidebar.svg' )
					)
				)
			)
		)
	);

	/* Single Product Sidebar Control */
	$wp_customize->add_setting(
		'product_sidebar_position',
		array(
			'default'           => beetan_default_option( 'product_sidebar_position' ),
			'sanitize_callback' => 'beetan_sanitize_select',
		)
	);
	$wp_customize->add_control(
		new Beetan_Customize_Radio_Image_Control( $wp_customize,
			'product_sidebar_position',
			array(
				'label'    => esc_html__( 'Single Product', 'beetan' ),
				'section'  => 'sidebar_settings_section',
				'settings' => 'product_sidebar_position',
				'choices'  => array(
					'no_sidebar'    => array(
						'label' => esc_html__( 'No Sidebar', 'beetan' ),
						'url'   => get_theme_file_uri( '/assets/images/full-width.svg' )
					),
					'left_sidebar'  => array(
						'label' => esc_html__( 'Left Sidebar', 'beetan' ),
						'url'   => get_theme_file_uri( '/assets/images/left-sidebar.svg' )
					),
					'right_sidebar' => array(
						'label' => esc_html__( 'Right Sidebar', 'beetan' ),
						'url'   => get_theme_file_uri( '/assets/images/right-sidebar.svg' )
					)
				)
			)
		)
	);
}
/*
* End Sidebar Settings
*/