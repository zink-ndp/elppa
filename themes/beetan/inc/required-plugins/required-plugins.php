<?php
defined( 'ABSPATH' ) or die( 'Keep Silent' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/required-plugins/class-tgm-plugin-activation.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Register the required plugins for this theme.
 */
function beetan_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = array(
		// WooCommerce
		array(
			'name'     => esc_html__( 'WooCommerce', 'beetan' ),
			'slug'     => 'woocommerce',
			'required' => false,
		),
		// Woo Variation Swatches
		array(
			'name'     => esc_html__( 'Variation Swatches for WooCommerce', 'beetan' ),
			'slug'     => 'woo-variation-swatches',
			'required' => false,
		),
		// Woo Additional Variation Images
		array(
			'name'     => esc_html__( 'Additional Variation Images Gallery for WooCommerce', 'beetan' ),
			'slug'     => 'woo-variation-gallery',
			'required' => false,
		),
	);

	/*
	 * Array of configuration settings.
	 */
	$config = array(
		'id'           => 'beetan', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '', // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true, // Show admin notices or not.
		'dismissable'  => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message'      => '', // Message to output right before the plugins table.
		'strings'      => array(
			'page_title' => __( 'Install Recommended Plugins', 'beetan' ),
			'menu_title' => __( 'Recommended Plugins', 'beetan' ),
			'return'     => __( 'Return to Recommended Plugins Installer', 'beetan' ),
		),
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'beetan_register_required_plugins' );

