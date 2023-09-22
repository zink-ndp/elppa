<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_TinyMCE_Control' ) ):
	class Beetan_Customize_TinyMCE_Control extends WP_Customize_Control {

		public  $type     = 'tinymce';
		private $placeholder;
		private $extras   = array();
		private $required = array();

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			$this->placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$this->extras      = isset( $args['extras'] ) ? $args['extras'] : array();
			$this->required    = isset( $args['required'] ) ? $args['required'] : array();

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
			wp_enqueue_media();
			wp_enqueue_editor();
			wp_enqueue_script( 'customize-tinymce-control', esc_url( get_theme_file_uri( "/assets/js/customize-tinymce-control{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-tinymce-control{$suffix}.js" ) ), true );
		}

		protected function render_content() {
			?>

            <div class="customize-control-notifications-container"></div>

            <label class="customize-control-tinymce-input-wrapper">
				<?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
            </label>

            <div class="customize-control-tinymce-input">
                <textarea style="height: 200px; width: 100%" rows="16" cols="20" class="wp-editor-area text"
                          id="<?php echo esc_attr( $this->id ) ?>" <?php $this->link(); ?>><?php echo wp_kses_post( $this->value() ) ?></textarea>
            </div>

            <div class="clear"></div>

			<?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<?php
		}
	}
endif;