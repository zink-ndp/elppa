<?php
/**
 * Customizer Control: section.
 * @package     Jot Shop
 * @author      Jot Shop
 * @copyright   Copyright (c) 2019, Jot Shop
 * @since       1.0.0
 */
if ( class_exists( 'WP_Customize_Section' ) ) {

	/**
	 * Adds a custom Customize Section for nested sections.
	 *
	 * @link https://gist.github.com/OriginalEXE/9a6183e09f4cae2f30b006232bb154af
	 * @since 1.0.31
	 * @see WP_Customize_Section
	 */
	class  Jot_Shop_WP_Customize_Section extends WP_Customize_Section {

		/**
		 * Section
		 *
		 * @since 1.0.31
		 * @var string
		 */
		public $section;

		/**
		 * Control type.
		 *
		 * @since  1.0.31
		 * @var string
		 */
		public $type = 'alm_section';

		/**
		 * Get section parameters for JS.
		 *
		 * @since 1.0.31
		 * @return array Exported parameters.
		 */
		public function json() {
			$array                   = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section' ) );
			$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
			$array['content']        = $this->get_content();
			$array['active']         = $this->active();
			$array['instanceNumber'] = $this->instance_number;

			if ( $this->panel ) {
				$array['customizeAction'] = sprintf(__('Customizing &#9656; %s','jot-shop'), esc_html( $this->manager->get_panel( $this->panel )->title ) );
			} else {
				$array['customizeAction'] = __('Customizing','jot-shop');
			}

			return $array;
		}
	}
}
