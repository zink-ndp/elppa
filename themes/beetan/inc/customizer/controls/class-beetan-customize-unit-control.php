<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Unit_Control' ) ):
	class Beetan_Customize_Unit_Control extends WP_Customize_Control {

		public  $type     = 'unit';
		private $placeholder;
		private $extras   = array();
		private $required = array();

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			$this->placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$this->extras      = isset( $args['extras'] ) ? $args['extras'] : array();
			$this->required    = isset( $args['required'] ) ? $args['required'] : array();
			$this->input_attrs = wp_parse_args( isset( $args['input_attrs'] ) ? $args['input_attrs'] : array(), array(
				'min'  => 0,
				'max'  => 100,
				'step' => 0.1
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
			wp_enqueue_script( 'customize-unit-control', esc_url( get_theme_file_uri( "/assets/js/customize-unit-control{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-unit-control{$suffix}.js" ) ), true );
			wp_enqueue_style( 'customize-unit-control', esc_url( get_theme_file_uri( "/assets/css/customize-unit-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-unit-control{$suffix}.css" ) ) );
		}

		private function parse_value( $value ) {
			$expression = '/(?P<unit>[0-9\.]+)(?P<type>%|r?em|px)\b/i';
			preg_match( $expression, $value, $matches );

			return $matches;
		}

		protected function render_content() {
			$values = $this->parse_value( $this->value() );
			$unit   = $values['unit'];
			$type   = $values['type'];
			?>

            <label>
                <div class="customize-control-notifications-container"></div>

                <div class="customize-control-unit-input-wrapper">
					<?php if ( ! empty( $this->label ) ) : ?>
                        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php endif; ?>

                    <div class="customize-control-unit-inputs">
                        <input type="number" value="<?php echo esc_attr( $unit ) ?>" <?php $this->input_attrs() ?>>
                        <select>
                            <option <?php selected( $type, 'px' ) ?> value="px">px</option>
                            <option <?php selected( $type, 'em' ) ?> value="em">em</option>
                            <option <?php selected( $type, 'rem' ) ?> value="rem">rem</option>
                            <option <?php selected( $type, '%' ) ?> value="%">%</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>">

                <div class="clear"></div>

				<?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
            </label>
			<?php
		}
	}
endif;