<?php
defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! class_exists( 'Beetan_Customize_Repeatable_Control' ) ):
	
	class Beetan_Customize_Repeatable_Control extends WP_Customize_Control {
		
		public $type         = 'repeatable';
		public $output       = array();
		public $fields       = array();
		public $row_label    = '';
		public $button_label = '';
		public $limit        = false;
		
		//protected $filtered_value = array();
		
		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
			
			$this->required     = isset( $args['required'] ) ? $args['required'] : false;
			$this->row_label    = isset( $args['row_label'] ) ? $args['row_label'] : $args['label'];
			$this->button_label = isset( $args['button_label'] ) ? $args['button_label'] : $args['label'];
			$this->limit        = isset( $args['limit'] ) ? $args['limit'] : false;
			$this->fields       = ( isset( $args['fields'] ) && is_array( $args['fields'] ) ) ? $args['fields'] : array();
			
			foreach ( $this->fields as $key => $value ) {
				if ( ! isset( $value['default'] ) ) {
					$this->fields[ $key ]['default'] = '';
				}
				if ( ! isset( $value['label'] ) ) {
					$this->fields[ $key ]['label'] = '';
				}
				
				$this->fields[ $key ]['id'] = $key;
				
				if ( isset( $value['type'] ) ) {
					switch ( $value['type'] ) {
						case 'dropdown-pages':
							// If the field is a dropdown-pages field then add it to args.
							$dropdown = wp_dropdown_pages( array(
								'name'              => '',
								'echo'              => 0,
								'show_option_none'  => esc_attr( $this->l10n( 'select-page' ) ),
								'option_none_value' => '0',
								'selected'          => '',
							) );
							// Hackily add in the data link parameter.
							$dropdown                           = str_replace( '<select', '<select data-field="' . esc_attr( $args['fields'][ $key ]['id'] ) . '"' . $this->get_link(), $dropdown );
							$args['fields'][ $key ]['dropdown'] = $dropdown;
							break;
					}
				}
			}
		}
		
		protected function l10n( $id = false ) {
			$translation_strings = array(
				'row'               => esc_attr__( 'row', 'beetan' ),
				'add-new'           => esc_attr__( 'Add new', 'beetan' ),
				'select-page'       => esc_attr__( 'Select a Page', 'beetan' ),
				'limit-rows'        => esc_attr__( 'Limit: %s rows', 'beetan' ), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				'hex-value'         => esc_attr__( 'Hex Value', 'beetan' ),
				'no-image-selected' => esc_attr__( 'No Image Selected', 'beetan' ),
				'remove'            => esc_attr__( 'Remove', 'beetan' ),
				'add-image'         => esc_attr__( 'Add Image', 'beetan' ),
				'change-image'      => esc_attr__( 'Change Image', 'beetan' ),
				'no-file-selected'  => esc_attr__( 'No File Selected', 'beetan' ),
				'add-file'          => esc_attr__( 'Add File', 'beetan' ),
				'change-file'       => esc_attr__( 'Change File', 'beetan' ),
			);
			
			$translation_strings = apply_filters( 'beetan_customize_repeatable_control_l10n', $translation_strings );
			
			if ( false === $id ) {
				return $translation_strings;
			}
			
			return $translation_strings[ $id ];
		}
		
		public function to_json() {
			parent::to_json();
			$this->json['required'] = $this->required;
			$this->json['default']  = ( isset( $this->default ) ) ? $this->default : $this->setting->default;
			$this->json['output']   = $this->output;
			$this->json['value']    = $this->value();
			$this->json['choices']  = $this->choices;
			$this->json['link']     = $this->get_link();
			$this->json['id']       = $this->id;
			/*if ( 'user_meta' === $this->option_type ) {
				$this->json[ 'value' ] = get_user_meta( get_current_user_id(), $this->id, TRUE );
			}*/
			$this->json['inputAttrs'] = '';
   
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}
			
			$this->json['fields']       = $this->fields;
			$this->json['row_label']    = $this->row_label;
			$this->json['button_label'] = $this->button_label;
			$this->json['limit']        = $this->limit;
   
			// If filtered_value has been set and is not empty we use it instead of the actual value.
			/*if ( is_array( $this->filtered_value ) && ! empty( $this->filtered_value ) ) {
				$this->json[ 'value' ] = $this->filtered_value;
			}*/
		}
		
		public function enqueue() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			
			wp_enqueue_style( 'dashicons' );
			
			// If we have a color picker field we need to enqueue the WordPress Color Picker style and script.
			if ( is_array( $this->fields ) && ! empty( $this->fields ) ) {
				foreach ( $this->fields as $field ) {
					if ( isset( $field['type'] ) && 'color' === $field['type'] ) {
						wp_enqueue_script( 'wp-color-picker' );
						wp_enqueue_style( 'wp-color-picker' );
						break;
					}
				}
				/*foreach ( $this->fields as $field ) {
					if ( isset( $field[ 'type' ] ) && 'dropdown-pages' === $field[ 'type' ] ) {
						wp_enqueue_script( 'kirki-dropdown-pages' );
						break;
					}
				}*/
			}
			
			wp_enqueue_script( 'customize-repeatable-control', esc_url( get_theme_file_uri( "/assets/js/customize-repeatable-control{$suffix}.js" ) ), array(
				'jquery',
				'customize-base',
				'jquery-ui-core',
				'jquery-ui-sortable'
			), beetan_assets_version( get_theme_file_uri( "/assets/js/customize-repeatable-control{$suffix}.js" ) ), true );
			
			wp_enqueue_style( 'customize-repeatable-control', esc_url( get_theme_file_uri( "/assets/css/customize-repeatable-control{$suffix}.css" ) ), array(), beetan_assets_version( get_theme_file_uri( "/assets/css/customize-repeatable-control{$suffix}.css" ) ) );
		}
		
		protected function render_content() {
			?>
            <label>
				<?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
    
				<?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php endif; ?>
                
                <input type="hidden" {{{ data.inputAttrs }}}
                       value="" <?php echo wp_kses_post( $this->get_link() ); ?> />
            </label>

            <ul class="repeatable-fields"></ul>
			
			<?php if ( $this->limit ) : ?>
                <p class="limit"><?php printf( esc_html( $this->l10n( 'limit-rows' ) ), esc_html( $this->limit ) ); ?></p>
			<?php endif; ?>

            <button class="button-secondary repeatable-add"><?php echo esc_html( $this->button_label ); ?></button>
			
			<?php
			$this->repeatable_js_template();
		}
		
		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 * Class variables for this control class are available in the `data` JS object.
		 *
		 * @access public
		 */
		public function repeatable_js_template() {
			?>
            <script type="text/html" class="customize-control-repeatable-content">
                <# var field; var index = data.index; #>

                <li class="repeatable-row minimized" data-row="{{{ index }}}">
                    <div class="repeatable-row-header">
                        <span class="repeatable-row-label"></span>
                        <i class="dashicons dashicons-arrow-down repeatable-minimize"></i>
                    </div>
                    
                    <div class="repeatable-row-content">
                        <# _.each( data, function( field, i ) { #>
                        <div class="repeatable-field repeatable-field-{{{ field.type }}}">

                            <# if ( 'text' === field.type || 'number' === field.type || 'url' === field.type || 'link'
                            === field.type || 'email' === field.type || 'tel' === field.type || 'date' === field.type )
                            { #>

                            <# if ( 'link' === field.type ) { #>
                            <# field.type = 'url' #>
                            <# } #>

                            <label>
                                <# if ( field.label ) { #>
                                <span class="customize-control-title">{{ field.label }}</span>
                                <# } #>

                                <# if ( field.description ) { #>
                                <span class="description customize-control-description">{{ field.description }}</span>
                                <# } #>
                                <input type="{{field.type}}" name="" value="{{{ field.default }}}"
                                       data-field="{{{ field.id }}}">
                            </label>

                            <# } else if ( 'hidden' === field.type ) { #>

                            <input type="hidden" data-field="{{{ field.id }}}"
                            <# if ( field.default ) { #> value="{{{field.default }}}"
                            <# } #> />

                            <# } else if ( 'checkbox' === field.type ) { #>

                            <label>
                                <input type="checkbox" value="true" data-field="{{{ field.id }}}"
                                <# if ( field.default ) { #> checked="checked"
                                <# } #> />
                                {{ field.label }}
                                <# if ( field.description ) { #>
                                {{ field.description }}
                                <# } #>
                            </label>

                            <# } else if ( 'select' === field.type ) { #>

                            <label>
                                <# if ( field.label ) { #>
                                <span class="customize-control-title">{{ field.label }}</span>
                                <# } #>
                                <# if ( field.description ) { #>
                                <span class="description customize-control-description">{{ field.description }}</span>
                                <# } #>
                                <select data-field="{{{ field.id }}}">
                                    <# _.each( field.choices, function( choice, i ) { #>
                                    <option value="{{{ i }}}"
                                    <# if ( field.default == i ) { #> selected="selected"
                                    <# } #>>{{ choice }}</option>
                                    <# }); #>
                                </select>
                            </label>

                            <# } else if ( 'dropdown-pages' === field.type ) { #>

                            <label>
                                <# if ( field.label ) { #>
                                <span class="customize-control-title">{{{data.label }}}</span>
                                <# } #>
                                <# if ( field.description ) { #>
                                <span class="description customize-control-description">{{{field.description }}}</span>
                                <# } #>
                                <div class="customize-control-content repeatable-dropdown-pages">{{{field.dropdown
                                    }}}
                                </div>
                            </label>

                            <# } else if ( 'radio' === field.type ) { #>

                            <label>
                                <# if ( field.label ) { #>
                                <span class="customize-control-title">{{ field.label }}</span>
                                <# } #>
                                <# if ( field.description ) { #>
                                <span class="description customize-control-description">{{ field.description }}</span>
                                <# } #>

                                <# _.each( field.choices, function( choice, i ) { #>
                                <label>
                                    <input type="radio" name="{{{ field.id }}}{{ index }}" data-field="{{{ field.id }}}"
                                           value="{{{ i }}}"
                                    <# if ( field.default == i ) { #> checked="checked"
                                    <# } #>> {{ choice }} <br/>
                                </label>
                                <# }); #>
                            </label>

                            <# } else if ( 'radio-image' === field.type ) { #>

                            <label>
                                <# if ( field.label ) { #>
                                <span class="customize-control-title">{{ field.label }}</span>
                                <# } #>
                                <# if ( field.description ) { #>
                                <span class="description customize-control-description">{{ field.description }}</span>
                                <# } #>

                                <# _.each( field.choices, function( choice, i ) { #>
                                <label for="{{{ field.id }}}_{{ index }}_{{{ i }}}">
                                    <input type="radio" id="{{{ field.id }}}_{{ index }}_{{{ i }}}"
                                           name="{{{ field.id }}}{{ index }}" data-field="{{{ field.id }}}"
                                           value="{{{ i }}}"
                                    <# if ( field.default == i ) { #> checked="checked"
                                    <# } #>>
                                    <img src="{{ choice }}">
                                </label>
                                <# }); #>
                            </label>

                            <# } else if ( 'color' === field.type ) { #>

                            <# var defaultValue = '';
                            if ( field.default ) {
                            if ( '#' !== field.default.substring( 0, 1 ) ) {
                            defaultValue = '#' + field.default;
                            } else {
                            defaultValue = field.default;
                            }
                            defaultValue = ' data-default-color=' + defaultValue; // Quotes added automatically.
                            } #>
                            <label>
                                <# if ( field.label ) { #>
                                <span class="customize-control-title">{{{field.label }}}</span>
                                <# } #>
                                <# if ( field.description ) { #>
                                <span class="description customize-control-description">{{{field.description }}}</span>
                                <# } #>
                                <input class="color-picker-hex" type="text" maxlength="7"
                                       placeholder="<?php echo esc_attr( $this->l10n( 'hex-value' ) ); ?>"
                                       value="{{{ field.default }}}" data-field="{{{ field.id }}}" {{ defaultValue }}/>

                            </label>

                            <# } else if ( 'textarea' === field.type ) { #>

                            <# if ( field.label ) { #>
                            <span class="customize-control-title">{{ field.label }}</span>
                            <# } #>
                            <# if ( field.description ) { #>
                            <span class="description customize-control-description">{{ field.description }}</span>
                            <# } #>
                            <textarea rows="5" data-field="{{{ field.id }}}">{{ field.default }}</textarea>

                            <# } #>
                        </div>
                        <# }); #>
                        
                        <button type="button" class="button-link repeatable-row-remove">
							<?php echo esc_attr( $this->l10n( 'remove' ) ); ?>
                        </button>
                    </div>
                </li>
            </script>
			<?php
		}
	}
endif;