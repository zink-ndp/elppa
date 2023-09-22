<?php
defined( 'ABSPATH' ) or die( 'Keep Silent' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function beetan_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function beetan_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/*
 * Select sanitization function
 */
function beetan_sanitize_select( $input, $setting ) {
	//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key( $input );
	
	//get the list of possible select options
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	//return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


/*
 * Multi select sanitization function
 */
function beetan_sanitize_multiselect( $input ) {
	// Initialize the new array that will hold the sanitize values
	$value = array();
	
	// Loop through the input and sanitize each of the values
	foreach ( $input as $key => $val ) {
		$value[ $key ] = sanitize_text_field( $val );
	}
	
	return $value;
}

/**
 * Sanitize the Multiple checkbox values.
 *
 * @param $values
 *
 * @return array
 */
function beetan_sanitize_multi_checkbox( $values ) {
	$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
	
	return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/*
 * Checkbox sanitization function
 */
function beetan_sanitize_boolean( $value ) {
	$filter = filter_var( $value, FILTER_VALIDATE_BOOLEAN );
	
	return is_null( $filter ) ? false : $filter;
}

/*
 * None sanitization function
 */
function beetan_sanitize_none( $value ) {
	return $value;
}

/*
 * Default Customizer Variable Array
 */
function beetan_setup_customizer_preset_variables() {
	return array(
		'site_background_color'                => array(
			'default' => '#f8f8f8'
		),
		'site_header_top_background_color'     => array(
			'default' => '#e9e9e9'
		),
		'site_header_background_color'         => array(
			'default' => '#ffffff'
		),
		'site_header_box_shadow'               => array(
			'default' => '#f1f1f1'
		),
		'site_container_width'                 => array(
			'default' => 1200
		),
		'sidebar_width'                        => array(
			'default' => 30
		),
		'primary_color'                        => array(
			'default' => '#29B475'
		),
		'text_color'                           => array(
			'default' => '#343a40'
		),
		'heading_color'                        => array(
			'default' => '#16252d'
		),
		'sub_heading_color'                    => array(
			'default' => '#16252d'
		),
		'link_color'                           => array(
			'default' => '#343a40'
		),
		'link_hover_color'                     => array(
			'default' => '#29B475'
		),
		'shop_products_gap'                    => array(
			'default' => 5
		),
		'blog_posts_gap'                       => array(
			'default' => 5
		),
		'blog_post_inner_gap'                  => array(
			'default' => 40
		),
		'blog_post_background_color'           => array(
			'default' => '#ffffff'
		),
		'box_layout_inner_gap'                 => array(
			'default' => 40
		),
		'box_layout_background_color'          => array(
			'default' => '#ffffff'
		),
		'base_font_scale'                      => array(
			'default' => 1.5
		),
		'base_font_size'                       => array(
			'default' => 16
		),
		'base_font_weight'                     => array(
			'default' => 400
		),
		'base_line_height'                     => array(
			'default' => 1.75
		),
		'paragraph_margin_top'                 => array(
			'default' => 0
		),
		'paragraph_margin_bottom'              => array(
			'default' => 30
		),
		'h1_font_size'                         => array(
			'default' => 48
		),
		'h2_font_size'                         => array(
			'default' => 40
		),
		'h3_font_size'                         => array(
			'default' => 32
		),
		'h4_font_size'                         => array(
			'default' => 28
		),
		'h5_font_size'                         => array(
			'default' => 24
		),
		'h6_font_size'                         => array(
			'default' => 20
		),
		'h1_font_weight'                       => array(
			'default' => 300
		),
		'h2_font_weight'                       => array(
			'default' => 300
		),
		'h3_font_weight'                       => array(
			'default' => 400
		),
		'h4_font_weight'                       => array(
			'default' => 400
		),
		'h5_font_weight'                       => array(
			'default' => 400
		),
		'h6_font_weight'                       => array(
			'default' => 500
		),
		'h1_line_height'                       => array(
			'default' => 1.3
		),
		'h2_line_height'                       => array(
			'default' => 1.25
		),
		'h3_line_height'                       => array(
			'default' => 1.3
		),
		'h4_line_height'                       => array(
			'default' => 1.2
		),
		'h5_line_height'                       => array(
			'default' => 1.75
		),
		'h6_line_height'                       => array(
			'default' => 1.75
		),
		'h1_margin_top'                        => array(
			'default' => 0
		),
		'h1_margin_bottom'                     => array(
			'default' => 30
		),
		'h2_margin_top'                        => array(
			'default' => 0
		),
		'h2_margin_bottom'                     => array(
			'default' => 16
		),
		'h3_margin_top'                        => array(
			'default' => 0
		),
		'h3_margin_bottom'                     => array(
			'default' => 16
		),
		'h4_margin_top'                        => array(
			'default' => 0
		),
		'h4_margin_bottom'                     => array(
			'default' => 16
		),
		'h5_margin_top'                        => array(
			'default' => 0
		),
		'h5_margin_bottom'                     => array(
			'default' => 0
		),
		'h6_margin_top'                        => array(
			'default' => 0
		),
		'h6_margin_bottom'                     => array(
			'default' => 0
		),
		'back_to_top_button_icon_size'         => array(
			'default' => 18
		),
		'back_to_top_button_background_color'  => array(
			'default' => '#000000'
		),
		'back_to_top_button_icon_color'        => array(
			'default' => '#ffffff'
		),
		'back_to_top_button_width'             => array(
			'default' => 50
		),
		'back_to_top_button_height'            => array(
			'default' => 50
		),
		'back_to_top_button_radius'            => array(
			'default' => 3
		),
		'back_to_top_button_bottom_offset'     => array(
			'default' => 50
		),
		'back_to_top_button_left_right_offset' => array(
			'default' => 50
		),
	);
}

/*
 * Customizer Preset CSS
 */
if ( ! function_exists( 'beetan_get_customizer_preset_css' ) ) {
	function beetan_get_customizer_preset_css( $values ) {
		ob_start();
		beetan_get_template( 'inc/css-variables.php', $values );
		
		$css = str_ireplace( array( '<style type="text/css">', '</style>' ), '', ob_get_clean() );
		
		return apply_filters( 'beetan_get_customizer_preset_css', $css );
	}
}

/*
 * Return Single preset value
 */
function beetan_get_customizer_preset_variable( $variable ) {
	$preset_variables = beetan_setup_customizer_preset_variables();
	$default          = $preset_variables[ $variable ]['default'];
	
	return get_theme_mod( $variable, $default );
}

/*
 * Return customizer preset option value for root CSS
 */
function beetan_get_customizer_preset_variables() {
	$variables = array();
	
	foreach ( array_keys( beetan_setup_customizer_preset_variables() ) as $value ) {
		$variables[ $value ] = beetan_get_customizer_preset_variable( $value );
	}
	
	return $variables;
}

/*
 * Enqueue Root CSS variable
 */
if ( ! function_exists( 'beetan_preset_css' ) ) {
	function beetan_preset_css() {
		$variables  = beetan_get_customizer_preset_variables();
		$stylesheet = beetan_get_customizer_preset_css( $variables );
		
		if ( ! is_admin() ) {
			// Add in front-end
			wp_add_inline_style( 'beetan-style', $stylesheet );
		} elseif ( is_admin() ) {
			// Add in admin
			wp_add_inline_style( 'wp-block-editor', $stylesheet );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'beetan_preset_css', 12 );
add_action( 'admin_enqueue_scripts', 'beetan_preset_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'beetan_customize_preview_js' ) ) {
	function beetan_customize_preview_js() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		wp_enqueue_script( 'beetan-customizer-preview', esc_url( get_theme_file_uri( "/assets/js/customizer-preview{$suffix}.js" ) ), array( 'customize-preview' ), beetan_assets_version( "/assets/js/customizer-preview{$suffix}.js" ), true );
	}
}
add_action( 'customize_preview_init', 'beetan_customize_preview_js' );

/*
 * Customize Controls Scripts
 */
if ( ! function_exists( 'beetan_customize_controls_enqueue_scripts' ) ) {
	function beetan_customize_controls_enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		wp_enqueue_script( 'customizer', esc_url( get_theme_file_uri( "/assets/js/customizer{$suffix}.js" ) ), array(
			'customize-controls',
			'underscore'
		), beetan_assets_version( "/assets/js/customizer{$suffix}.js" ), true );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'beetan_customize_controls_enqueue_scripts' );
