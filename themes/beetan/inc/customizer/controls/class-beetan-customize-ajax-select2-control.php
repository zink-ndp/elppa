<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Ajax_Select2_Control' ) ):

	class Beetan_Customize_Ajax_Select2_Control extends WP_Customize_Control {

		public  $type = 'ajax-select2';
		private $placeholder;
		private $required;
		private $action;

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			$this->placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$this->required    = isset( $args['required'] ) ? $args['required'] : false;
			$this->action      = isset( $args['action'] ) ? 'customize_ajax_select2_' . $args['action'] : 'customize_ajax_select2_' . $id;
		}

		public function to_json() {
			parent::to_json();

			$this->json['placeholder'] = $this->placeholder;
			$this->json['required']    = $this->required;
			$this->json['action']      = $this->action;
		}

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_style( 'select2', esc_url( get_theme_file_uri( "/assets/css/select2{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/select2{$suffix}.css" ) ) );
			wp_enqueue_script( 'select2', esc_url( get_theme_file_uri( "/assets/js/select2{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/select2{$suffix}.js" ) ), true );

			wp_enqueue_style( 'customize-ajax-select2-control', esc_url( get_theme_file_uri( "/assets/css/customize-ajax-select2-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-ajax-select2-control{$suffix}.css" ) ) );
			wp_enqueue_script( 'customize-ajax-select2-control', esc_url( get_theme_file_uri( "/assets/js/customize-ajax-select2-control{$suffix}.js" ) ), array(
				'jquery',
				'select2'
			), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-ajax-select2-control{$suffix}.js" ) ), true );

			wp_localize_script( 'customize-ajax-select2-control', 'CustomizeAjaxSelect2Object', array(
				'nonce'   => wp_create_nonce( 'customize_ajax_select2_nonce' ),
				'ajaxurl' => esc_url( admin_url( 'admin-ajax.php', 'relative' ) )
			) );
		}

		protected function render_content() {
			$options = apply_filters( 'beetan_customize_ajax_select2_selected_choices', array(), $this->value(), $this->id );
			?>

            <label>
				<?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

                <select <?php $this->link(); ?> class="customize-control-ajax-select2-input">
					<?php
					foreach ( $options as $value => $label ) {
						printf( '<option selected="selected" value="%s">%s</option>', esc_attr( $value ), esc_html( $label ) );
					}
					?>
                </select>

				<?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
            </label>

			<?php
		}
	}
endif;