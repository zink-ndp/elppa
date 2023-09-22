<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Select2_Control' ) ):

	class Beetan_Customize_Select2_Control extends WP_Customize_Control {

		public $type = 'select2';
		private $placeholder;
		private $require;
		private $multiselect;

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			$this->placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$this->required    = isset( $args['required'] ) ? $args['required'] : false;
			$this->multiselect    = isset( $args['multiselect'] ) ? $args['multiselect'] : false;
		}

		public function to_json() {
			parent::to_json();

			$this->json['placeholder'] = $this->placeholder;
			$this->json['required']    = $this->required;
			$this->json['multiselect']    = $this->multiselect;
		}

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_style( 'select2', esc_url( get_theme_file_uri( "/assets/css/select2{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/select2{$suffix}.css" ) ) );
			wp_enqueue_script( 'select2', esc_url( get_theme_file_uri( "/assets/js/select2{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/select2{$suffix}.js" ) ), true );

			wp_enqueue_script( 'customize-select2-control', esc_url( get_theme_file_uri( "/assets/js/customize-select2-control{$suffix}.js" ) ), array(
				'jquery',
				'select2'
			), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-select2-control{$suffix}.js" ) ), true );
			wp_enqueue_style( 'customize-select2-control', esc_url( get_theme_file_uri( "/assets/css/customize-select2-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-select2-control{$suffix}.css" ) ) );
		}

		protected function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
            
            $multiselect = $this->multiselect ? 'multiple="multiple"' : '';
			?>

            <label>
				<?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

                <select <?php $this->link(); ?> class="customize-control-select2-input" <?php echo esc_attr( $multiselect ); ?>>
					<?php
					foreach ( $this->choices as $values => $labels ) {
						if ( is_array( $labels ) ) {
							echo '<optgroup label="' . esc_attr( $labels['label'] ) . '">';

							foreach ( $labels['options'] as $value => $label ) {
								echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
							}

							echo '</optgroup>';
						} else {
							echo '<option value="' . esc_attr( $values ) . '"' . selected( $this->value(), $values, false ) . '>' . esc_html( $labels ) . '</option>';
						}
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