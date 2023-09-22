<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Typography_Control' ) ):
	class Beetan_Customize_Typography_Control extends WP_Customize_Control {
		public  $type   = 'typography';
		private $placeholder;
		private $extras = array();

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			$this->placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$this->extras      = isset( $args['extras'] ) ? $args['extras'] : array();
		}

		public function to_json() {
			parent::to_json();

			$this->json['placeholder'] = $this->placeholder;
			$this->json['extras']      = $this->extras;
		}

		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_style( 'select2', esc_url( get_theme_file_uri( "/assets/css/select2{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/select2{$suffix}.css" ) ) );
			wp_enqueue_script( 'select2', esc_url( get_theme_file_uri( "/assets/js/select2{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( get_theme_file_uri( "/assets/js/select2{$suffix}.js" ) ), true );

			wp_enqueue_style( 'customize-typography-control', esc_url( get_theme_file_uri( "/assets/css/customize-typography-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-typography-control{$suffix}.css" ) ) );
			wp_enqueue_script( 'customize-typography-control', esc_url( get_theme_file_uri( "/assets/js/customize-typography-control{$suffix}.js" ) ), array(
				'jquery',
				'select2'
			), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-typography-control{$suffix}.js" ) ), true );

			wp_localize_script( 'customize-typography-control', 'CustomizeTypographyObject', array(
				'standardFonts'      => beetan_standard_fonts(),
				'standardFontWidth'  => beetan_standard_font_width(),
				'standardFontSubset' => beetan_standard_font_subset(),
				'googleFonts'        => beetan_all_google_fonts()
			) );
		}

		protected function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
            ?>
            <label>
				<?php if ( ! empty( $this->label ) ) { ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>

                <select <?php $this->link(); ?> class="customize-control-typography-input" style="width: 100%" >
					<?php
					foreach ( $this->choices as $value => $label ) {
						if ( is_array( $this->value() ) ) {
							$selected = in_array( $value, $this->value() ) ? 'selected="selected"' : '';
						} else {
							$selected = selected( $this->value(), $value, false );
						}

						printf( '<option value="%s" %s>%s</option>', esc_attr( $value ), esc_attr( $selected ), esc_html( $label ) );
					}
					?>
                </select>

				<?php if ( ! empty( $this->description ) ) { ?>
                    <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
            </label>
			<?php
		}
	}
endif;

if ( ! class_exists( 'Beetan_Customize_Typography' ) ) {
	class Beetan_Customize_Typography {
		public function __construct( $wp_customize, $id, $args = array() ) {
			$this->add_settings( $wp_customize, $id, $args );
			$this->add_controls( $wp_customize, $id, $args );
		}

		private function add_settings( $wp_customize, $id, $args = array() ) {
			$wp_customize->add_setting( sprintf( '%s[family]', $id ), array(
				'default' => isset( $args['default']['family'] ) ? $args['default']['family'] : false,
				'sanitize_callback' => 'sanitize_key',
			) );

			$wp_customize->add_setting( sprintf( '%s[style]', $id ), array(
				'default' => isset( $args['default']['style'] ) ? $args['default']['style'] : false,
				'sanitize_callback' => 'beetan_sanitize_multiselect',
			) );

//			$wp_customize->add_setting( sprintf( '%s[subset]', $id ), array(
//				'default' => isset( $args['default']['subset'] ) ? $args['default']['subset'] : false,
////				'sanitize_callback' => 'beetan_sanitize_select',
//			) );
		}

		private function add_controls( $wp_customize, $id, $args ) {
			$wp_customize->add_control(
				new Beetan_Customize_Typography_Control( $wp_customize,
					sprintf( '%s[family]', $id ),
					array(
						'label'       => sprintf( esc_html__( '%s Family', 'beetan' ), $args['label'] ), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						'description' => wp_kses_post( isset( $args['description'] ) ? $args['description'] : '' ),
						'placeholder' => esc_html__( 'Font Family', 'beetan' ),
						'section'     => $args['section'],
						'choices'     => beetan_google_fonts(),
						'extras'      => array(
							'id' => $id
						)
					)
				)
			);

			$wp_customize->add_control(
				new Beetan_Customize_Typography_Control( $wp_customize,
					sprintf( '%s[style]', $id ),
					array(
						'label'       => sprintf( esc_html__( '%s Style', 'beetan' ), $args['label'] ), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
						'description' => wp_kses_post( isset( $args['description'] ) ? $args['description'] : '' ),
						'placeholder' => esc_html__( 'Font Style', 'beetan' ),
						'section'     => $args['section'],
						'choices'     => beetan_standard_font_width(),
						'extras'      => array(
							'id' => $id
						)
					)
				)
			);

//			$wp_customize->add_control(
//				new Beetan_Customize_Typography_Control( $wp_customize,
//					sprintf( '%s[subset]', $id ),
//					array(
//						'label'       => sprintf( esc_html__( '%s Subset', 'beetan' ), $args['label'] ),
//						// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
//						'description' => wp_kses_post( isset( $args['description'] ) ? $args['description'] : '' ),
//						'placeholder' => esc_html__( 'Font Subset', 'beetan' ),
//						'section'     => $args['section'],
//						'choices'     => beetan_standard_font_subset(),
//						'extras'      => array(
//							'id' => $id
//						)
//					)
//				)
//			);
		}
	}
}