<?php
/*
* Start Blog Settings
*/
$wp_customize->add_panel(
	'panel_blog',
	array(
		'priority'   => 31,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Blog Options', 'beetan' ),
	)
);

$wp_customize->add_section(
	'blog_archive',
	array(
		'title' => esc_html__( 'Blog Archive', 'beetan' ),
//		'priority' => 11,
		'panel' => 'panel_blog',
	)
);

/* Blog Layout Control */
$wp_customize->add_setting(
	'blog_layout',
	array(
		'default'           => beetan_default_option( 'blog_layout' ),
		'sanitize_callback' => 'sanitize_key'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'blog_layout',
		array(
			'label'       => esc_html__( 'Layout', 'beetan' ),
			'description' => esc_html__( 'Choose a layout for the blog posts.', 'beetan' ),
			'section'     => 'blog_archive',
			'choices'     => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/default.svg' )
				),
				'list'    => array(
					'label' => esc_html__( 'List', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/list
						.svg' )
				),
				'grid'    => array(
					'label' => esc_html__( 'Grid', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/grid.svg' )
				),
				'masonry' => array(
					'label' => esc_html__( 'Masonry', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/masonry.svg' )
				)
			)
		)
	)
);

/* Grid column */
$wp_customize->add_setting(
	'blog_grid_columns',
	array(
		'default'           => beetan_default_option( 'blog_grid_columns' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Buttons_Control( $wp_customize,
		'blog_grid_columns',
		array(
			'label'           => esc_html__( 'Columns', 'beetan' ),
			'section'         => 'blog_archive',
			'settings'        => 'blog_grid_columns',
			'choices'         => array(
				'2' => esc_html__( '2', 'beetan' ),
				'3' => esc_html__( '3', 'beetan' ),
				'4' => esc_html__( '4', 'beetan' ),
			),
			'active_callback' => function () {
				if ( in_array( get_theme_mod( 'blog_layout', 'default' ), array( 'grid', 'masonry' ) ) ) {
					return true;
				}

				return false;
			},
		)
	)
);

/* Blog post content */
$wp_customize->add_setting(
	'blog_content',
	array(
		'default'           => beetan_default_option( 'blog_content' ),
		'sanitize_callback' => 'beetan_sanitize_select'
	)
);
$wp_customize->add_control(
	'blog_content',
	array(
		'type'            => 'radio',
		'section'         => 'blog_archive',
		'priority'        => 10,
		'label'           => esc_html__( 'Archive Post Content', 'beetan' ),
		'choices'         => array(
			'full'    => esc_html__( 'Show full content', 'beetan' ),
			'summary' => esc_html__( 'Show summary', 'beetan' ),
		),
		'active_callback' => function () {
			if ( get_theme_mod( 'blog_layout', 'default' ) === 'default' ) {
				return true;
			}

			return false;
		},
	)
);
/* Blog excerpt length */
$wp_customize->add_setting(
	'blog_excerpt_length',
	array(
		'default'           => beetan_default_option( 'blog_excerpt_length' ),
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Number_Control( $wp_customize,
		'blog_excerpt_length',
		array(
			'label'           => esc_html__( 'Summary Length', 'beetan' ),
			'description'     => esc_html__( 'Summary length as words count.', 'beetan' ),
			'section'         => 'blog_archive',
			'input_attrs'     => array(
				'min'  => 10,
				'max'  => 50,
				'step' => 5,
			),
			'active_callback' => function () {
				if ( ( get_theme_mod( 'blog_layout', 'default' ) === 'default' ) && ( get_theme_mod( 'blog_content', 'full' ) === 'full' ) ) {
					return false;
				}

				return true;
			},
		)
	)
);
/* Blog read more button */
$wp_customize->add_setting(
	'blog_readmore',
	array(
		'default'           => beetan_default_option( 'blog_readmore' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'blog_readmore',
		array(
			'label'           => esc_html__( 'Enable Read More', 'beetan' ),
			'description'     => wp_kses_post( __( 'Show READ MORE button.', 'beetan' ) ),
			'section'         => 'blog_archive',
			'active_callback' => function () {
				if ( ( get_theme_mod( 'blog_layout', 'default' ) === 'default' ) && ( get_theme_mod( 'blog_content', 'full' ) === 'full' ) ) {
					return false;
				}

				return true;
			},
		)
	)
);

/* Space between archive blog posts  */
$wp_customize->add_setting(
	'blog_posts_gap',
	array(
		'default'           => beetan_default_option( 'blog_posts_gap' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'blog_posts_gap',
		array(
			'label'       => esc_html__( 'Gap Between Posts', 'beetan' ),
			'section'     => 'blog_archive',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

/* Blog post inner padding */
$wp_customize->add_setting(
	'blog_post_inner_gap',
	array(
		'default'           => beetan_default_option( 'blog_post_inner_gap' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'blog_post_inner_gap',
		array(
			'label'       => esc_html__( 'Gap Inner Post', 'beetan' ),
			'section'     => 'blog_archive',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);

// Post background color
$wp_customize->add_setting(
	'blog_post_background_color',
	array(
		'default'           => maybe_hash_hex_color( beetan_default_option( 'blog_post_background_color' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Alpha_Color_Control( $wp_customize,
		'blog_post_background_color',
		array(
			'label'   => esc_html__( 'Post Background Color', 'beetan' ),
			'section' => 'blog_archive',
		)
	)
);

/* Remove Blog Posts Featured Image Padding */
$wp_customize->add_setting(
	'blog_featured_image_display_style',
	array(
		'default'           => beetan_default_option( 'blog_featured_image_display_style' ),
		'sanitize_callback' => 'beetan_sanitize_select'
	)
);
$wp_customize->add_control(
	'blog_featured_image_display_style',
	array(
		'type'        => 'radio',
		'section'     => 'blog_archive',
		'label'       => esc_html__( 'Featured Image Display Style', 'beetan' ),
		'description' => esc_html__( 'Cover style is only for BOX container layout.', 'beetan' ),
		'choices'     => array(
			'cover'   => esc_html__( 'Cover', 'beetan' ),
			'contain' => esc_html__( 'Contain', 'beetan' ),
		),
	)
);