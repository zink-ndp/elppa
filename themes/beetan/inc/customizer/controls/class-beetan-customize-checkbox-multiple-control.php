<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Checkbox_Multiple_Control' ) ) {
	
	class Beetan_Customize_Checkbox_Multiple_Control extends WP_Customize_Control {
		public $type = 'checkbox-multiple';
		
		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_enqueue_script( 'customize-checkbox-multiple-control', esc_url( get_theme_file_uri( "/assets/js/customize-checkbox-multiple-control{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-checkbox-multiple-control{$suffix}.js" ) ), true );
		}
		
		protected function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			?>
			
			<?php if ( ! empty( $this->label ) ) { ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php } ?>
			
			<?php if ( ! empty( $this->description ) ) { ?>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php } ?>
			
			<?php
			$multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
			?>

            <ul class="customize-control-multiple-control-choices">
				<?php foreach ( $this->choices as $value => $label ) { ?>
                    <li>
                        <label>
                            <input type="checkbox"
                                   value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?>>
							<?php echo esc_html( $label ); ?>
                        </label>
                    </li>
				<?php } ?>
            </ul>

            <input type="hidden" <?php $this->link() ?>
                   value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>">
			<?php
		}
	}
}