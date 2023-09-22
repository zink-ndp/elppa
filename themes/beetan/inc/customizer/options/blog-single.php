<?php
// Single post settings
$wp_customize->add_section(
	'single_post',
	array(
		'title' => esc_html__( 'Single Post', 'beetan' ),
//		'priority' => 11,
		'panel' => 'panel_blog',
	)
);
// Hide Single Post
$wp_customize->add_setting(
	'hide_single_post_title',
	array(
		'default'           => beetan_default_option( 'hide_single_post_title' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'hide_single_post_title',
		array(
			'label'   => esc_html__( 'Hide Single Post Title', 'beetan' ),
			'section' => 'single_post'
		)
	)
);