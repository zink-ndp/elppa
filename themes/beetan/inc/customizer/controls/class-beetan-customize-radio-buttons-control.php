<?php
/**
 * Radio buttons control
 *
 * @package Botiga
 */

if ( ! class_exists( 'Beetan_Customize_Radio_Buttons_Control' ) ) {
	class Beetan_Customize_Radio_Buttons_Control extends WP_Customize_Control {

		public $type = 'radio-buttons';

		public $cols;

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_style( 'customize-radio-buttons-control', esc_url( get_theme_file_uri( "/assets/css/customize-radio-buttons-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-radio-buttons-control{$suffix}.css" ) ) );
		}

		public function render_content() {
			$allowed_tags = array(
				'div'  => array(
					'style' => array()
				),
				'svg'  => array(
					'class'       => true,
					'xmlns'       => true,
					'width'       => true,
					'height'      => true,
					'viewbox'     => true,
					'aria-hidden' => true,
					'role'        => true,
					'focusable'   => true,
				),
				'path' => array(
					'd' => true,
				),
				'rect' => array(
					'x'         => true,
					'y'         => true,
					'width'     => true,
					'height'    => true,
					'transform' => true
				),
			);
			?>
            <div class="text_radio_button_control">
				<?php if ( ! empty( $this->label ) ) { ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>

				<?php if ( ! empty( $this->description ) ) { ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

                <div class="radio-buttons">
					<?php foreach ( $this->choices as $key => $value ) { ?>
                        <label class="radio-button-label">
                            <input type="radio" name="<?php echo esc_attr( $this->id ); ?>"
                                   value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
                            <span><?php echo wp_kses( $value, $allowed_tags ); ?></span>
                        </label>
					<?php } ?>
                </div>
            </div>
			<?php
		}
	}
}