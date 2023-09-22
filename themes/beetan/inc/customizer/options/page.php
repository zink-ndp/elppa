<?php
$wp_customize->add_section(
	'page_options',
	array(
		'title'    => esc_html__( 'Page Options', 'beetan' ),
		'priority' => 32,
	)
);

/* Hide page title */
$wp_customize->add_setting(
	'hide_page_title',
	array(
		'default'           => beetan_default_option( 'hide_page_title' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'hide_page_title',
		array(
			'label'   => esc_html__( 'Hide Page Title', 'beetan' ),
			'section' => 'page_options'
		)
	)
);

/* Center page title */
$wp_customize->add_setting(
	'page_title_align_center',
	array(
		'default'           => beetan_default_option( 'page_title_align_center' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'page_title_align_center',
		array(
			'label'   => esc_html__( 'Page Title Align Center', 'beetan' ),
			'section' => 'page_options'
		)
	)
);