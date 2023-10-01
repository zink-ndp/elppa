<?php

/**
 * Handles sending form field config to DOM
 *
 * @package Caldera_Forms Modified by QuantumCloud
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 CalderaWP LLC
 */
class Qcformbuilder_Forms_Field_Localizer {

	/**
	 * The configs to be printed
	 *
	 * @since 1.5.0
	 *
	 * @var
	 */
	protected static $localized;

	/**
	 * Add form
	 *
	 * Functions as factory for Qcformbuilder_Forms_Render_FieldsJS
	 *
	 * @since 1.5.0
	 *
	 * @param array $form
	 * @param $current_form_count
	 */
	public static function add_form( array  $form, $current_form_count ){
		$fieldjs = new Qcformbuilder_Forms_Field_JS( $form, $current_form_count  );

		self::$localized[ $current_form_count ] = $fieldjs->to_array();
		add_action( 'wp_footer', array( __CLASS__, 'localize_cb' ), 100 );

	}

	/**
	 * Output the configs as CDATA
	 *
	 * @since 1.5.0
	 *
	 * @uses "wp_footer"
	 */
	public static function localize_cb(){
		if ( ! empty( self::$localized ) ) {

			$slug = Qcformbuilder_Forms_Render_Assets::field_script_to_localize_slug();
			$data = array();

			if( ! has_filter( 'qcformbuilder_forms_field_default_state_sanitizer' ) ){
				//add_filter( 'qcformbuilder_forms_field_default_state_sanitizer', array( 'Qcformbuilder_Forms_Sanitize', 'remove_scripts' ) );
			}
			foreach ( self::$localized as $form_instance => $form_data ){
				$form_data = array_merge( $form_data, array(
					'error_strings' => self::error_strings()
				));
				$data[ $form_instance ] = $form_data;

				if(
					! empty( self::$localized[ $form_instance ][ 'fields' ] )
					&& ! empty( self::$localized[ $form_instance ][ 'fields' ][ 'defaults' ] )
				){
					foreach( self::$localized[ $form_instance ][ 'fields' ][ 'defaults' ]  as $field_id => &$default ){
						if( empty( $default ) ){
							continue;
						} elseif ( is_numeric( $default ) || is_string( $default )) {
							/**
							 * Set callback function to sanitize default values passed to CFState JavaScript for fields
							 *
							 * @since 1.5.7
							 *
							 * @param bool $default Field default
							 * @param
							 */
							$default = apply_filters( 'qcformbuilder_forms_field_default_state_sanitizer', $default, $field_id );
						}else{
							unset ( self::$localized[ $form_instance ][ 'fields' ][ 'defaults' ][ $field_id ] );

						}

					}

				}

			}

			$wp_scripts = wp_scripts();
			wp_localize_script( $slug, 'CFFIELD_CONFIG', $data );

			$wp_scripts->print_extra_script( $slug, true );

		}
	}

	/**
	 * Error messages to localize
	 *
	 * @since 1.5.3
	 *
	 * @return array
	 */
	protected static function error_strings(){
		$strings = array(
			'mixed_protocol' => __( 'Submission URL and current URL protocols do not match. Form may not function properly.', 'qcformbuilder-forms' ),
			'jquery_old'     => __( 'An out of date version of jQuery is loaded on the page. Form may not function properly.', 'qcformbuilder-forms' )
		);

		if( ! current_user_can( Qcformbuilder_Forms::get_manage_cap( 'admin' )) ){
			unset( $strings[ 'jquery_old' ] );
		}

		return $strings;

	}
}