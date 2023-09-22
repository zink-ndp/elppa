<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Radio_Image_Control' ) ):

	class Beetan_Customize_Radio_Image_Control extends WP_Customize_Control {
		public $type = 'radio-image';
		
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			
			$this->required    = isset( $args['required'] ) ? $args['required'] : array();
		}
		
		public function to_json() {
			parent::to_json();
			
			$this->json['required']    = $this->required;
		}
  
		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_script( 'customize-radio-image-control', esc_url( get_theme_file_uri( "/assets/js/customize-radio-image-control{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-radio-image-control{$suffix}.js" ) ), true );
			wp_enqueue_style( 'customize-radio-image-control', esc_url( get_theme_file_uri( "/assets/css/customize-radio-image-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-radio-image-control{$suffix}.css" ) ) );
		}

		protected function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}

			$name = '_customize-radio-image-' . $this->id;
			?>

			<?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

            <ul class="customize-control-radio-image-control-choices">
				<?php foreach ( $this->choices as $value => $options ) : ?>
                    <li>
                        <label for="<?php echo esc_attr( $this->id ) ?>-<?php echo esc_attr( $value ) ?>">
                            <span class="screen-reader-text"><?php echo esc_html( $options['label'] ) ?></span>
                            <input type="radio" <?php checked( $this->value(), $value ) ?> value="<?php echo $value ?>" name="<?php echo $name ?>" id="<?php echo $this->id ?>-<?php echo $value ?>" <?php $this->link(); ?> /><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <img src="<?php echo esc_url( $options['url'] ) ?>"
                                 alt="<?php echo esc_attr( $options['label'] ) ?>"
                                 title="<?php echo esc_attr( $options['label'] ) ?>"/>
                        </label>
                    </li>
				<?php endforeach; ?>
            </ul>

			<?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>
			<?php
		}
	}
endif;