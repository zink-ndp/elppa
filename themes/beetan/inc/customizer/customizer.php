<?php
/**
 * Beetan Theme Customizer
 *
 * @package Beetan
 */

if ( ! function_exists( 'beetan_customizer_controls' ) ) {
	/**
	 * Customizer controls
	 */
	function beetan_customizer_controls() {
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-radio-image-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-radio-buttons-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-toggle-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-number-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-tinymce-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-alpha-color.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-typography.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-unit-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-heading.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-range-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-select2-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-checkbox-multiple-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once get_theme_file_path( '/inc/customizer/controls/class-beetan-customize-repeatable-control.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}
add_action( 'customize_register', 'beetan_customizer_controls', 1 );

if ( ! function_exists( 'beetan_customize_register' ) ) {
	/**
	 * Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function beetan_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		
		if ( beetan_is_woocommerce_active() ) {
			// Change WooCommerce panel priority.
			$wp_customize->get_panel( 'woocommerce' )->priority  = 33;
		}
		
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title',
					'render_callback' => 'beetan_customize_partial_blogname',
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'beetan_customize_partial_blogdescription',
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'custom_logo',
				array(
					'selector'            => '.site-branding',
					'render_callback'     => 'the_custom_logo',
					'container_inclusive' => true,
				)
			);
		}

		require get_theme_file_path( '/inc/customizer/options/header.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/layout.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/sidebar.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/blog.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/blog-single.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/page.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/color.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/typography.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_theme_file_path( '/inc/customizer/options/footer.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		
		if ( beetan_is_woocommerce_active() ) {
			require get_theme_file_path( '/inc/customizer/options/woocommerce.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}
	}
}
add_action( 'customize_register', 'beetan_customize_register' );
