<?php
/**
 * ColorAlpha class
 */

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Alpha_Color_Control' ) ) {
	class Beetan_Customize_Alpha_Color_Control extends WP_Customize_Control {

		public $type = 'alpha-color';

		public $palette;

		public $show_opacity;

		/**
		 * Enqueue scripts/styles for the color picker.
		 */
		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_script(
				'customize-alpha-color-control',
				esc_url( get_theme_file_uri( "/assets/js/customize-alpha-color-control{$suffix}.js" ) ),
				array( 'jquery', 'wp-color-picker' ),
				beetan_assets_version( get_theme_file_uri( "/assets/js/customize-alpha-color-control{$suffix}.js" ) ),
				true
			);

			wp_enqueue_style(
				'customize-alpha-color-control',
				esc_url( get_theme_file_uri( "/assets/css/customize-alpha-color-control{$suffix}.css" ) ),
				array( 'wp-color-picker' ),
				beetan_assets_version( get_theme_file_uri( "/assets/css/customize-alpha-color-control{$suffix}.css" ) )
			);
        }

		/**
		 * Render the control.
		 */
		public function render_content() {
			// Process the palette
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				// Default to true.
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}

			// Support passing show_opacity as string or boolean. Default to true.
			$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

			// Begin the output. ?>

			<?php
			if ( isset( $this->label ) && '' !== $this->label ) {
				echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
            ?>
            <label>
				<?php // Output the label and description if they were passed in.
				if ( isset( $this->description ) && '' !== $this->description ) {
					echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
                ?>
                <input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
            </label>
			<?php
		}

	}
}