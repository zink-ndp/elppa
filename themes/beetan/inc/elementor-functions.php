<?php
if ( ! function_exists( 'beetan_check_elementor_hide_page_title' ) ) {
	/**
	 * Check hide post/page title.
	 *
	 * @param bool $value default value.
	 *
	 * @return bool
	 */
	function beetan_check_elementor_hide_title( $value ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );

			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$value = false;
			}
		}

		return $value;
	}
}
add_filter( 'beetan_page_title_visibility', 'beetan_check_elementor_hide_title' );
add_filter( 'beetan_post_title_visibility', 'beetan_check_elementor_hide_title' );