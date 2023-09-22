<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Range_Control' ) ):
	class Beetan_Customize_Range_Control extends WP_Customize_Control {

		public $type = 'range';

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			$this->placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$this->extras      = isset( $args['extras'] ) ? $args['extras'] : array();
			$this->required    = isset( $args['required'] ) ? $args['required'] : array();
			$this->input_attrs = wp_parse_args( isset( $args['input_attrs'] ) ? $args['input_attrs'] : array(), array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			) );

			if ( ! isset( $this->extras['id'] ) ) {
				$this->extras['id'] = $id;
			}
		}

		public function to_json() {
			parent::to_json();

			$this->json['placeholder'] = $this->placeholder;
			$this->json['extras']      = $this->extras;
			$this->json['required']    = $this->required;
		}

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_enqueue_script( 'customize-range-control', esc_url( get_theme_file_uri( "/assets/js/customize-range-control{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-range-control{$suffix}.js" ) ), true );
			wp_enqueue_style( 'customize-range-control', esc_url( get_theme_file_uri( "/assets/css/customize-range-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-range-control{$suffix}.css" ) ) );
		}

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

                <div class="customize-control-range-wrap">
                    <input class="customize-control-range-slider" type="range" <?php $this->link(); ?>
                           value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs() ?>>

                    <div class="customize-control-range-value-wrap">
	                    <?php if ( ! empty( $this->input_attrs['prefix'] ) ) { ?>
                            <span class="prefix"><?php echo esc_html( $this->input_attrs['prefix'] ); ?></span>
	                    <?php } ?>

                        <input class="customize-control-range-value" type="number"
                           value='<?php echo esc_attr( $this->value() ); ?>' <?php $this->input_attrs() ?>>

	                    <?php if ( ! empty( $this->input_attrs['suffix'] ) ) { ?>
                            <span class="suffix"><?php echo esc_html( $this->input_attrs['suffix'] ); ?></span>
	                    <?php } ?>
                    </div>
                </div>

				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
			</label>
			<?php
		}
	}
endif;