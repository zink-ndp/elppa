<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Color_Scheme_Control' ) ):

	class Beetan_Customize_Color_Scheme_Control extends WP_Customize_Control {

		public $type = 'color-scheme';

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_script( 'customize-color-scheme-control', esc_url( get_theme_file_uri( "/assets/js/customize-color-scheme-control{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-color-scheme-control{$suffix}.js" ) ), true );
			wp_enqueue_style( 'customize-color-scheme-control', esc_url( get_theme_file_uri( "/assets/css/customize-color-scheme-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-color-scheme-control{$suffix}.css" ) ) );
		}

		protected function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}

			$name = '_customize-color-scheme-' . $this->id;
			?>

			<?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

            <ul class="customize-control-color-scheme-control-choices">
				<?php foreach ( $this->choices as $value => $options ) :
					$colors = is_array( $options['color'] ) ? $options['color'] : array( $options['color'] );
					?>
                    <li>
                        <label for="<?php echo esc_attr( $this->id ) ?>-<?php echo esc_attr( $value ) ?>">
                            <span class="screen-reader-text"><?php echo esc_html( $options['label'] ) ?></span>
                            <input type="radio" <?php checked( $this->value(), $value ) ?> value="<?php echo $value ?>" name="<?php echo $name ?>" id="<?php echo $this->id ?>-<?php echo $value ?>" <?php $this->link(); ?> /><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
                            <div class="scheme-container">
								<?php foreach ( $colors as $color ): ?>
                                    <span style="background-color: <?php echo esc_attr( $color ) ?>; width: <?php echo( 100 / count( $colors ) ) ?>%"></span>
								<?php endforeach; ?>
                            </div>
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