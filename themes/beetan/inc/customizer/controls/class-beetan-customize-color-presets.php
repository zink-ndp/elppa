<?php
	
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
	
	if ( ! class_exists( 'Beetan_Customize_Color_Presets' ) ):
		
		class Beetan_Customize_Color_Presets {
			
			public function __construct( $wp_customize, $id, $args = array() ) {
				
				if ( ! isset( $args[ 'presets' ] ) ) {
					return $wp_customize;
				}
				
				$this->add_settings( $wp_customize, $id, $args );
				$this->add_controls( $wp_customize, $id, $args );
			}
			
			private function add_settings( $wp_customize, $id, $args ) {
				
				$wp_customize->add_setting( $id, array(
					'default'           => $args[ 'default' ],
					'sanitize_callback' => $args[ 'sanitize_callback' ],
					'transport'         => 'postMessage',
				) );
				
				foreach ( (array) $args[ 'presets' ] as $setting => $option ) {
					$wp_customize->add_setting( $setting, array(
						'default'           => $option[ 'default' ],
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage',
					) );
				}
			}
			
			private function add_controls( $wp_customize, $id, $args ) {
				
				$wp_customize->add_control( new Beetan_Customize_Color_Scheme_Control( $wp_customize, $id, array(
					'label'       => esc_html( $args[ 'label' ] ),
					'description' => isset( $args[ 'description' ] ) ? $args[ 'description' ] : '',
					'section'     => $args[ 'section' ],
					'choices'     => $args[ 'choices' ],
					'priority'    => isset( $args[ 'priority' ] ) ? $args[ 'priority' ] : 60
				) ) );
				
				foreach ( (array) $args[ 'presets' ] as $setting => $option ) {
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
						'label'       => $option[ 'label' ],
						'description' => $option[ 'description' ],
						'section'     => 'colors',
						'priority'    => 70
					) ) );
				}
			}
		}
	endif;