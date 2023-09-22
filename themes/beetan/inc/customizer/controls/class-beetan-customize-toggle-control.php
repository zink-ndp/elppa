<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Toggle_Control' ) ):

	class Beetan_Customize_Toggle_Control extends WP_Customize_Control {

		public  $type     = 'toggle';
		private $extras   = array();
		private $required = array();

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			$this->extras   = isset( $args['extras'] ) ? $args['extras'] : array();
			$this->required = isset( $args['required'] ) ? $args['required'] : array();

			if ( ! isset( $this->extras['id'] ) ) {
				$this->extras['id'] = $id;
			}
		}

		public function to_json() {

			parent::to_json();

			$this->json['extras']   = $this->extras;
			$this->json['required'] = $this->required;
		}

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_style( 'customize-toggle-control', esc_url( get_theme_file_uri( "/assets/css/customize-toggle-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-toggle-control{$suffix}.css" ) ) );
			wp_enqueue_script( 'customize-toggle-control', esc_url( get_theme_file_uri( "/assets/js/customize-toggle-control{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-toggle-control{$suffix}.js" ) ), true );
		}

		protected function render_content() { ?>

            <div class="customize-toggle-control-wrapper">

                <label>
					<?php if ( ! empty( $this->label ) ) : ?>
                        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php endif; ?>
                </label>

                <label class="toggle">
                    <input type="checkbox" <?php checked( $this->value(), 1 ) ?> value="1" <?php $this->link(); ?>>
                    <div class="slider"></div>
                </label>
            </div>

            <div class="clear"></div>

			<?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<?php
		}
	}
endif;