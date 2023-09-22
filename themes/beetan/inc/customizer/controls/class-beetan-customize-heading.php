<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Heading_Control' ) ):

	class Beetan_Customize_Heading_Control extends WP_Customize_Control {

		public $type = 'heading';

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
		}

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_enqueue_style( 'customize-heading-control', esc_url( get_theme_file_uri( "/assets/css/customize-heading-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-heading-control{$suffix}.css" ) ) );
		}

		protected function render_content() {
			?>
			<?php if ( ! empty( $this->label ) ) : ?>
                <h4 class="customize-heading-control-title"><?php echo esc_html( $this->label ); ?></h4>
			<?php endif;
		}
	}
endif;

if ( ! class_exists( 'Beetan_Customize_Heading' ) ):

	class Beetan_Customize_Heading {

		public function __construct( $wp_customize, $section, $title, $priority = null ) {
			static $customize_heading_control_id = 1;

			$this->add_settings( $wp_customize, $customize_heading_control_id );
			$this->add_controls( $wp_customize, $title, $section, $priority, $customize_heading_control_id );

			$customize_heading_control_id ++;
		}

		private function add_settings( $wp_customize, $id ) {
			$wp_customize->add_setting( sprintf( 'customize-heading-control-%d', $id ), array(
				'sanitize_callback' => 'sanitize_key'
			) );
		}

		private function add_controls( $wp_customize, $title, $section, $priority, $id ) {
			$wp_customize->add_control( new Beetan_Customize_Heading_Control( $wp_customize, sprintf( 'customize-heading-control-%d', $id ), array(
				'label'    => $title,
				'section'  => $section,
				'priority' => $priority,
			) ) );
		}
	}

endif;