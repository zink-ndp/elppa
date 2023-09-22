<?php
/*
 * General
 */
$wp_customize->add_section(
	'shop_general_settings_section',
	array(
		'title'    => esc_html__( 'General', 'beetan' ),
		'panel'    => 'woocommerce',
		'priority' => 1
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'shop_general_settings_section',
	esc_html__( 'Quantity Input', 'beetan' )
);

/* Quantity Plus/Minus Button */
$wp_customize->add_setting(
	'product_quantity_plus_minus_button',
	array(
		'default'           => beetan_default_option( 'product_quantity_plus_minus_button' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'product_quantity_plus_minus_button',
		array(
			'label'    => esc_html__( 'Enable Quantity +/- button', 'beetan' ),
			'section'  => 'shop_general_settings_section',
			'settings' => 'product_quantity_plus_minus_button',
		)
	)
);

/* Quantity Input Style */
$wp_customize->add_setting(
	'product_quantity_input_style',
	array(
		'default'           => beetan_default_option( 'product_quantity_input_style' ),
		'sanitize_callback' => 'sanitize_key'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'product_quantity_input_style',
		array(
			'label'    => esc_html__( 'Quantity Style', 'beetan' ),
			'section'  => 'shop_general_settings_section',
			'settings' => 'product_quantity_input_style',
			'choices'  => array(
				'style-1' => array(
					'label' => esc_html__( 'Style 1', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/qty-1.svg' )
				),
				'style-2' => array(
					'label' => esc_html__( 'Style 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/qty-2.svg' )
				)
			),
			'required' => array( 'product_quantity_plus_minus_button', true )
		)
	)
);

/*
 * Shop Archive
 */
$wp_customize->add_section(
	'shop_archive_settings_section',
	array(
		'title'    => esc_html__( 'Shop Archive', 'beetan' ),
		'panel'    => 'woocommerce',
		'priority' => 1
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'shop_archive_settings_section',
	esc_html__( 'General', 'beetan' )
);

/* Shop Archive Title */
$wp_customize->add_setting(
	'enable_shop_archive_title',
	array(
		'default'           => beetan_default_option( 'enable_shop_archive_title' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_shop_archive_title',
		array(
			'label'    => esc_html__( 'Enable Shop Title', 'beetan' ),
			'section'  => 'shop_archive_settings_section',
			'settings' => 'enable_shop_archive_title',
		)
	)
);

/* Shop Archive Breadcrumb */
$wp_customize->add_setting(
	'enable_shop_archive_breadcrumb',
	array(
		'default'           => beetan_default_option( 'enable_shop_archive_breadcrumb' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_shop_archive_breadcrumb',
		array(
			'label'    => esc_html__( 'Enable Shop Breadcrumb', 'beetan' ),
			'section'  => 'shop_archive_settings_section',
			'settings' => 'enable_shop_archive_breadcrumb',
		)
	)
);

/* Shop Archive Result Count */
$wp_customize->add_setting(
	'enable_shop_archive_result_count',
	array(
		'default'           => beetan_default_option( 'enable_shop_archive_result_count' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_shop_archive_result_count',
		array(
			'label'    => esc_html__( 'Enable Shop Result Count', 'beetan' ),
			'section'  => 'shop_archive_settings_section',
			'settings' => 'enable_shop_archive_result_count',
		)
	)
);

/* Shop Archive Product Sorting */
$wp_customize->add_setting(
	'enable_shop_archive_product_sorting',
	array(
		'default'           => beetan_default_option( 'enable_shop_archive_product_sorting' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_shop_archive_product_sorting',
		array(
			'label'    => esc_html__( 'Enable Shop Product Sorting', 'beetan' ),
			'section'  => 'shop_archive_settings_section',
			'settings' => 'enable_shop_archive_product_sorting',
		)
	)
);

/* Shop Archive Product List/Grid View */
$wp_customize->add_setting(
	'enable_shop_archive_product_view',
	array(
		'default'           => beetan_default_option( 'enable_shop_archive_product_view' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_shop_archive_product_view',
		array(
			'label'    => esc_html__( 'Enable Shop Product (List/Grid) View', 'beetan' ),
			'section'  => 'shop_archive_settings_section',
			'settings' => 'enable_shop_archive_product_view',
		)
	)
);

/* Shop Archive Filter */
$wp_customize->add_setting(
	'enable_shop_archive_offcanvas_sidebar',
	array(
		'default'           => beetan_default_option( 'enable_shop_archive_offcanvas_sidebar' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_shop_archive_offcanvas_sidebar',
		array(
			'label'    => esc_html__( 'Enable Shop Sidebar as Offcanvas Filter', 'beetan' ),
			'section'  => 'shop_archive_settings_section',
			'settings' => 'enable_shop_archive_offcanvas_sidebar',
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'shop_archive_settings_section',
	esc_html__( 'Product Pagination', 'beetan' )
);

/* Product Pagination Type */
$wp_customize->add_setting(
	'shop_pagination_type',
	array(
		'default'           => beetan_default_option( 'shop_pagination_type' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'shop_pagination_type',
		array(
			'label'   => __( 'Shop Pagination Type', 'beetan' ),
			'section' => 'shop_archive_settings_section',
			'type'    => 'select',
			'choices' => array(
				'default'         => __( 'Default Pagination', 'beetan' ),
				'load_more'       => __( 'Load More', 'beetan' ),
				'infinite_scroll' => __( 'Infinite Scroll', 'beetan' ),
			)
		)
	)
);

/*
 * Product Catalog
 */

/* Space between shop products  */
$wp_customize->add_setting(
	'shop_products_gap',
	array(
		'default'           => beetan_default_option( 'shop_products_gap' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'shop_products_gap',
		array(
			'label'       => esc_html__( 'Gap Between Products', 'beetan' ),
			'section'     => 'woocommerce_product_catalog',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px'
			)
		)
	)
);


/*
 * Single Product Page Section
 */
$wp_customize->add_section(
	'single_product_settings_section',
	array(
		'title'    => esc_html__( 'Single Product', 'beetan' ),
		'panel'    => 'woocommerce',
		'priority' => 1
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'single_product_settings_section',
	esc_html__( 'General', 'beetan' )
);

/* Enable Single Product Breadcrumb */
$wp_customize->add_setting(
	'enable_single_product_breadcrumb',
	array(
		'default'           => beetan_default_option( 'enable_single_product_breadcrumb' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_single_product_breadcrumb',
		array(
			'label'    => esc_html__( 'Enable Breadcrumb', 'beetan' ),
			'section'  => 'single_product_settings_section',
			'settings' => 'enable_single_product_breadcrumb',
		)
	)
);

/* Sticky Product Summary */
$wp_customize->add_setting(
	'sticky_product_summary',
	array(
		'default'           => beetan_default_option( 'sticky_product_summary' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'sticky_product_summary',
		array(
			'label'    => esc_html__( 'Enable Sticky Product Summary', 'beetan' ),
			'section'  => 'single_product_settings_section',
			'settings' => 'sticky_product_summary',
		)
	)
);

/* Enable Single AJAX Add to Cart */
$wp_customize->add_setting(
	'enable_single_ajax_add_to_cart',
	array(
		'default'           => beetan_default_option( 'enable_single_ajax_add_to_cart' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_single_ajax_add_to_cart',
		array(
			'label'    => esc_html__( 'Enable Single AJAX Add to Cart', 'beetan' ),
			'section'  => 'single_product_settings_section',
			'settings' => 'enable_single_ajax_add_to_cart',
		)
	)
);

/* Enable Upsells Products */
$wp_customize->add_setting(
	'enable_upsells',
	array(
		'default'           => beetan_default_option( 'enable_upsells' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_upsells',
		array(
			'label'    => esc_html__( 'Enable Upsells', 'beetan' ),
			'section'  => 'single_product_settings_section',
			'settings' => 'enable_upsells',
		)
	)
);

/* Enable Related Products */
$wp_customize->add_setting(
	'enable_related_products',
	array(
		'default'           => beetan_default_option( 'enable_related_products' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_related_products',
		array(
			'label'    => esc_html__( 'Enable Related Products', 'beetan' ),
			'section'  => 'single_product_settings_section',
			'settings' => 'enable_related_products',
		)
	)
);

new Beetan_Customize_Heading( $wp_customize,
	'single_product_settings_section',
	esc_html__( 'Sticky Add to Cart', 'beetan' )
);

/* Sticky Add to Cart */
$wp_customize->add_setting(
	'sticky_add_to_cart',
	array(
		'default'           => beetan_default_option( 'sticky_add_to_cart' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'sticky_add_to_cart',
		array(
			'label'    => esc_html__( 'Enable Sticky Add to Cart', 'beetan' ),
			'section'  => 'single_product_settings_section',
			'settings' => 'sticky_add_to_cart',
		)
	)
);

/* Sticky Add to Cart Position */
$wp_customize->add_setting(
	'sticky_add_to_cart_position',
	array(
		'default'           => beetan_default_option( 'sticky_add_to_cart_position' ),
		'sanitize_callback' => 'sanitize_key'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Buttons_Control( $wp_customize,
		'sticky_add_to_cart_position',
		array(
			'label'           => esc_html__( 'Sticky Add to Cart Position', 'beetan' ),
			'section'         => 'single_product_settings_section',
			'settings'        => 'sticky_add_to_cart_position',
			'choices'         => array(
				'top'    => esc_html__( 'Top', 'beetan' ),
				'bottom' => esc_html__( 'Bottom', 'beetan' ),
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'sticky_add_to_cart', true ) ) {
					return true;
				}
				
				return false;
			},
		)
	)
);

/* Sticky Add to Cart Visibility */
$wp_customize->add_setting(
	'sticky_add_to_cart_visibility',
	array(
		'default'           => beetan_default_option( 'sticky_add_to_cart_visibility' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'sticky_add_to_cart_visibility',
		array(
			'label'           => __( 'Sticky Add to Cart Visibility', 'beetan' ),
			'section'         => 'single_product_settings_section',
			'type'            => 'select',
			'choices'         => array(
				'all'          => __( 'Show on All Devices', 'beetan' ),
				'desktop-only' => __( 'Show on Desktop Only', 'beetan' ),
				'mobile-only'  => __( 'Show on Mobile/Tablet Only', 'beetan' ),
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'sticky_add_to_cart', true ) ) {
					return true;
				}
				
				return false;
			},
		)
	)
);

/*
 * Checkout Section
 */

/* Checkout page layout */
$wp_customize->add_setting(
	'shop_checkout_layout',
	array(
		'default'           => beetan_default_option( 'shop_checkout_layout' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'shop_checkout_layout',
		array(
			'label'    => esc_html__( 'Checkout Layout', 'beetan' ),
			'section'  => 'woocommerce_checkout',
			'settings' => 'shop_checkout_layout',
			'choices'  => array(
				'layout-1' => array(
					'label' => esc_html__( 'layout 1', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/cart-layout-1.svg' )
				),
				'layout-2' => array(
					'label' => esc_html__( 'layout 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/cart-layout-2.svg' )
				),
				'layout-3' => array(
					'label' => esc_html__( 'Multistep Checkout', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/checkout-multistep.svg' )
				)
			),
			'priority' => 9
		)
	)
);

/* Enable sticky order summary */
$wp_customize->add_setting(
	'sticky_checkout_order_summary',
	array(
		'default'           => beetan_default_option( 'sticky_checkout_order_summary' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'sticky_checkout_order_summary',
		array(
			'label'           => esc_html__( 'Sticky Order Summary', 'beetan' ),
			'section'         => 'woocommerce_checkout',
			'settings'        => 'sticky_checkout_order_summary',
			'active_callback' => function () {
				if ( 'layout-2' === get_theme_mod( 'shop_checkout_layout', 'layout-1' ) ) {
					return true;
				}
				
				return false;
			},
			'priority'        => 9
		)
	)
);

/* Enable apply coupon field */
$wp_customize->add_setting(
	'enable_apply_coupon',
	array(
		'default'           => beetan_default_option( 'enable_apply_coupon' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_apply_coupon',
		array(
			'label'    => esc_html__( 'Enable Apply Coupon Filed', 'beetan' ),
			'section'  => 'woocommerce_checkout',
			'settings' => 'enable_apply_coupon',
			'priority' => 9
		)
	)
);

/* Enable order notes field */
$wp_customize->add_setting(
	'enable_order_notes',
	array(
		'default'           => beetan_default_option( 'enable_order_notes' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_order_notes',
		array(
			'label'    => esc_html__( 'Enable Order Notes Filed', 'beetan' ),
			'section'  => 'woocommerce_checkout',
			'settings' => 'enable_order_notes',
			'priority' => 9
		)
	)
);

/* Change Place Order button */
$wp_customize->add_setting(
	'change_place_order_button_text',
	array(
		'default'           => beetan_default_option( 'change_place_order_button_text' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'change_place_order_button_text',
		array(
			'label'    => esc_html__( 'Change "Place Order" Button Text', 'beetan' ),
			'section'  => 'woocommerce_checkout',
			'settings' => 'change_place_order_button_text',
			'priority' => 9
		)
	)
);

/* Place Order button text */
$wp_customize->add_setting(
	'place_order_button_text',
	array(
		'default'           => beetan_default_option( 'place_order_button_text' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'place_order_button_text',
	array(
		'type'            => 'text',
		'label'           => esc_html__( '"Place Order" Button Text', 'beetan' ),
		'section'         => 'woocommerce_checkout',
		'active_callback' => function () {
			if ( get_theme_mod( 'change_place_order_button_text', false ) ) {
				return true;
			}
			
			return false;
		},
		'priority'        => 9
	)
);

/* Enable Price on Place Order button */
$wp_customize->add_setting(
	'enable_price_on_place_order_button',
	array(
		'default'           => beetan_default_option( 'enable_price_on_place_order_button' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_price_on_place_order_button',
		array(
			'label'    => esc_html__( 'Enable Price on "Place Order" Button', 'beetan' ),
			'section'  => 'woocommerce_checkout',
			'settings' => 'enable_price_on_place_order_button',
			'priority' => 9
		)
	)
);

/* Enable Distraction Free Checkout */
$wp_customize->add_setting(
	'enable_distraction_free_checkout',
	array(
		'default'           => beetan_default_option( 'enable_distraction_free_checkout' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_distraction_free_checkout',
		array(
			'label'    => esc_html__( 'Enable Distraction Free Checkout', 'beetan' ),
			'section'  => 'woocommerce_checkout',
			'settings' => 'enable_distraction_free_checkout',
			'priority' => 9
		)
	)
);

/*
 * Cart Section
 */
$wp_customize->add_section(
	'shop_cart_settings_section',
	array(
		'title'    => esc_html__( 'Cart', 'beetan' ),
		'panel'    => 'woocommerce',
		'priority' => 21
	)
);

/* Cart page layout */
$wp_customize->add_setting(
	'shop_cart_layout',
	array(
		'default'           => beetan_default_option( 'shop_cart_layout' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control( $wp_customize,
		'shop_cart_layout',
		array(
			'label'    => esc_html__( 'Cart Layout', 'beetan' ),
			'section'  => 'shop_cart_settings_section',
			'settings' => 'shop_cart_layout',
			'choices'  => array(
				'layout-1' => array(
					'label' => esc_html__( 'layout 1', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/cart-layout-1.svg' )
				),
				'layout-2' => array(
					'label' => esc_html__( 'layout 2', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/cart-layout-2.svg' )
				)
			)
		)
	)
);

/* Sticky Cart totals */
$wp_customize->add_setting(
	'sticky_cart_totals',
	array(
		'default'           => beetan_default_option( 'sticky_cart_totals' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'sticky_cart_totals',
		array(
			'label'           => esc_html__( 'Sticky Cart Totals', 'beetan' ),
			'section'         => 'shop_cart_settings_section',
			'settings'        => 'sticky_cart_totals',
			'active_callback' => function () {
				if ( 'layout-2' === get_theme_mod( 'shop_cart_layout', 'layout-1' ) ) {
					return true;
				}
				
				return false;
			},
		)
	)
);

/* Cart auto update */
$wp_customize->add_setting(
	'cart_auto_update',
	array(
		'default'           => beetan_default_option( 'cart_auto_update' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'cart_auto_update',
		array(
			'label'    => esc_html__( 'Cart Auto Update on Quantity Change', 'beetan' ),
			'section'  => 'shop_cart_settings_section',
			'settings' => 'cart_auto_update'
		)
	)
);

/* Change Proceed to Checkout button text */
$wp_customize->add_setting(
	'change_proceed_to_checkout_button_text',
	array(
		'default'           => beetan_default_option( 'change_proceed_to_checkout_button_text' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'change_proceed_to_checkout_button_text',
		array(
			'label'    => esc_html__( 'Change "Proceed to Checkout" Button Text', 'beetan' ),
			'section'  => 'shop_cart_settings_section',
			'settings' => 'change_proceed_to_checkout_button_text',
		)
	)
);

/* Proceed to Checkout button text */
$wp_customize->add_setting(
	'proceed_to_checkout_button_text',
	array(
		'default'           => beetan_default_option( 'proceed_to_checkout_button_text' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'proceed_to_checkout_button_text',
	array(
		'type'            => 'text',
		'label'           => esc_html__( '"Proceed to Checkout" Button Text', 'beetan' ),
		'section'         => 'shop_cart_settings_section',
		'active_callback' => function () {
			if ( get_theme_mod( 'change_proceed_to_checkout_button_text', false ) ) {
				return true;
			}
			
			return false;
		},
	)
);

/* Hide cart page coupon form */
$wp_customize->add_setting(
	'hide_coupon_cart_page',
	array(
		'default'           => beetan_default_option( 'hide_coupon_cart_page' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'hide_coupon_cart_page',
		array(
			'label'    => esc_html__( 'Hide Coupon Form', 'beetan' ),
			'section'  => 'shop_cart_settings_section',
			'settings' => 'hide_coupon_cart_page',
		)
	)
);

/* Enable cross-sells */
$wp_customize->add_setting(
	'enable_cart_cross_sells',
	array(
		'default'           => beetan_default_option( 'enable_cart_cross_sells' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_cart_cross_sells',
		array(
			'label'    => esc_html__( 'Enable Cross-Sells', 'beetan' ),
			'section'  => 'shop_cart_settings_section',
			'settings' => 'enable_cart_cross_sells',
		)
	)
);

/* Cross-sells Products limit */
$wp_customize->add_setting(
	'cart_cross_sells_products_limit',
	array(
		'default'           => beetan_default_option( 'cart_cross_sells_products_limit' ),
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'cart_cross_sells_products_limit',
		array(
			'label'           => esc_html__( 'Cross-Sells Products Limit', 'beetan' ),
			'section'         => 'shop_cart_settings_section',
			'input_attrs'     => array(
				'min'  => 1,
				'max'  => 4,
				'step' => 1,
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'enable_cart_cross_sells', true ) ) {
					return true;
				}
				
				return false;
			},
		)
	)
);

/* Cross-sells Columns */
$wp_customize->add_setting(
	'cart_cross_sells_columns',
	array(
		'default'           => beetan_default_option( 'cart_cross_sells_columns' ),
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'cart_cross_sells_columns',
		array(
			'label'           => esc_html__( 'Cross-Sells Columns', 'beetan' ),
			'section'         => 'shop_cart_settings_section',
			'input_attrs'     => array(
				'min'  => 1,
				'max'  => 4,
				'step' => 1,
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'enable_cart_cross_sells', true ) ) {
					return true;
				}
				
				return false;
			},
		)
	)
);

/* Mini Cart */
new Beetan_Customize_Heading( $wp_customize,
	'shop_cart_settings_section',
	esc_html__( 'Mini Cart', 'beetan' )
);

$wp_customize->add_setting(
	'enable_mini_cart',
	array(
		'default'           => beetan_default_option( 'enable_mini_cart' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_mini_cart',
		array(
			'label'    => esc_html__( 'Enable Mini Cart', 'beetan' ),
			'section'  => 'shop_cart_settings_section',
			'settings' => 'enable_mini_cart',
		)
	)
);

/* Mini Cart Layout */
$wp_customize->add_setting(
	'mini_cart_layout',
	array(
		'default'           => beetan_default_option( 'mini_cart_layout' ),
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Radio_Image_Control(
		$wp_customize,
		'mini_cart_layout',
		array(
			'label'           => __( 'Mini Cart Layout', 'beetan' ),
			'section'         => 'shop_cart_settings_section',
			'settings'        => 'mini_cart_layout',
			'choices'         => array(
				'dropdown' => array(
					'label' => esc_html__( 'Dropdown', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/minicart-layout-1.svg' )
				),
				'floating' => array(
					'label' => esc_html__( 'Floating', 'beetan' ),
					'url'   => get_theme_file_uri( '/assets/images/minicart-layout-2.svg' )
				)
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'enable_mini_cart', true ) ) {
					return true;
				}
				
				return false;
			},
		)
	)
);

/*
 * Currency Switcher Section
 */
$wp_customize->add_section(
	'currency_switcher_section',
	array(
		'title'    => esc_html__( 'Currency Switcher', 'beetan' ),
		'panel'    => 'woocommerce',
		'priority' => 22
	)
);

/* Enable Currency Switcher */
$wp_customize->add_setting(
	'enable_currency_switcher',
	array(
		'default'           => beetan_default_option( 'enable_currency_switcher' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_currency_switcher',
		array(
			'label'    => esc_html__( 'Enable Currency Switcher', 'beetan' ),
			'section'  => 'currency_switcher_section',
			'settings' => 'enable_currency_switcher',
		)
	)
);

/* Add New Currency Switcher */
$wp_customize->add_setting(
	'woo_currency_switcher',
	array(
		'default'           => beetan_default_option( 'woo_currency_switcher' ),
		'sanitize_callback' => 'beetan_sanitize_none'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Repeatable_Control( $wp_customize,
		'woo_currency_switcher',
		array(
			'label'        => esc_html__( 'Currency Switcher', 'beetan' ),
			'description'  => esc_html__( 'Add new currency.', 'beetan' ),
			'section'      => 'currency_switcher_section',
			'row_label'    => esc_attr__( 'Currency', 'beetan' ),
			'button_label' => esc_attr__( 'Add New', 'beetan' ),
			
			'fields'   => array(
				'currency'           => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'Currency', 'beetan' ),
					'choices' => beetan_wc_get_currencies(),
					'default' => get_woocommerce_currency(),
				),
				'currency_rate'      => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Currency Rate', 'beetan' ),
					'description' => esc_html__( 'Currency Conversion fixed rate based on default currency. 1 For default currency.', 'beetan' ),
				),
				'currency_position'  => array(
					'type'    => 'select',
					'label'   => esc_attr__( 'Currency Position', 'beetan' ),
					'choices' => beetan_wc_get_currency_position(),
					'default' => get_option( 'woocommerce_currency_pos' ),
				),
				'thousand_separator' => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Thousand Separator', 'beetan' ),
					'default' => get_option( 'woocommerce_price_thousand_sep' )
				),
				'decimal_separator'  => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Decimal Separator', 'beetan' ),
					'default' => get_option( 'woocommerce_price_decimal_sep' )
				),
				'decimal_number'     => array(
					'type'    => 'number',
					'label'   => esc_attr__( 'Number of Decimals', 'beetan' ),
					'default' => get_option( 'woocommerce_price_num_decimals' )
				),
			),
			'required' => array( 'enable_currency_switcher', true )
		)
	)
);

/*
 * Payment Icons Section
 */
$wp_customize->add_section(
	'payment_icons_settings_section',
	array(
		'title'    => esc_html__( 'Payment Icons', 'beetan' ),
		'panel'    => 'woocommerce',
		'priority' => 23
	)
);

/* Payment Icons Area Heading */
$wp_customize->add_setting(
	'payment_icons_area_heading',
	array(
		'default'           => beetan_default_option( 'payment_icons_area_heading' ),
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'payment_icons_area_heading',
		array(
			'type'    => 'text',
			'label'   => __( 'Payment Icons Area Heading', 'beetan' ),
			'section' => 'payment_icons_settings_section',
		)
	)
);

/* Payment Icons */
$wp_customize->add_setting(
	'payment_icons',
	array(
		'default'           => beetan_default_option( 'payment_icons' ),
		'sanitize_callback' => 'beetan_sanitize_multiselect',
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Select2_Control( $wp_customize,
		'payment_icons',
		array(
			'label'       => esc_html__( 'Payment Icons', 'beetan' ),
			'section'     => 'payment_icons_settings_section',
			'multiselect' => true,
			'choices'     => beetan_payment_icons()
		)
	)
);

/* Payment Icons Placement */
$wp_customize->add_setting(
	'payment_icons_placement',
	array(
		'default'           => beetan_default_option( 'payment_icons_placement' ),
		'sanitize_callback' => 'beetan_sanitize_multi_checkbox'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Checkbox_Multiple_Control( $wp_customize,
		'payment_icons_placement',
		array(
			'label'       => esc_html__( 'Payment Icons Placement', 'beetan' ),
			'description' => esc_html__( 'Select where you want to show icons.', 'beetan' ),
			'section'     => 'payment_icons_settings_section',
			'choices'     => array(
				'footer'         => esc_html__( 'Site Footer', 'beetan' ),
				'cart-sidebar'   => esc_html__( 'Cart Page Sidebar', 'beetan' ),
				'single-product' => esc_html__( 'Single Product below SKU & Category', 'beetan' ),
			)
		)
	)
);

/*
 * Search
 */
$wp_customize->add_section(
	'products_search_settings_section',
	array(
		'title'    => esc_html__( 'Search', 'beetan' ),
		'panel'    => 'woocommerce',
		'priority' => 24
	)
);

/* Search post type */
$wp_customize->add_setting(
	'beetan_search_post_type',
	array(
		'default'           => beetan_default_option( 'beetan_search_post_type' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'beetan_search_post_type',
		array(
			'label'   => __( 'Search Post Type', 'beetan' ),
			'section' => 'products_search_settings_section',
			'type'    => 'select',
			'choices' => array(
				'post'    => __( 'Blog Post', 'beetan' ),
				'product' => __( 'Product', 'beetan' ),
			)
		)
	)
);

/* Enable Ajax Search */
$wp_customize->add_setting(
	'enable_ajax_search',
	array(
		'default'           => beetan_default_option( 'enable_ajax_search' ),
		'sanitize_callback' => 'beetan_sanitize_boolean'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Toggle_Control( $wp_customize,
		'enable_ajax_search',
		array(
			'label'           => esc_html__( 'Enable Ajax Search', 'beetan' ),
			'section'         => 'products_search_settings_section',
			'settings'        => 'enable_ajax_search',
			'active_callback' => function () {
				if ( 'product' === beetan_get_option('beetan_search_post_type') ) {
					return true;
				}
				
				return false;
			}
		)
	)
);

/* Search result limit */
$wp_customize->add_setting(
	'ajax_search_result_limit',
	array(
		'default'           => beetan_default_option( 'ajax_search_result_limit' ),
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Beetan_Customize_Range_Control( $wp_customize,
		'ajax_search_result_limit',
		array(
			'label'           => esc_html__( 'Search Result Limit', 'beetan' ),
			'section'         => 'products_search_settings_section',
			'input_attrs'     => array(
				'min'  => 1,
				'max'  => 20,
				'step' => 1,
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'enable_ajax_search', false ) && 'product' === beetan_get_option('beetan_search_post_type') ) {
					return true;
				}
				
				return false;
			}
		)
	)
);

/* Search result order by */
$wp_customize->add_setting(
	'ajax_search_result_order_by',
	array(
		'default'           => beetan_default_option( 'ajax_search_result_order_by' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'ajax_search_result_order_by',
		array(
			'label'           => __( 'Search Result Order By', 'beetan' ),
			'section'         => 'products_search_settings_section',
			'type'            => 'select',
			'choices'         => array(
				'none'           => __( 'None', 'beetan' ),
				'title'          => __( 'Product Name', 'beetan' ),
				'price'          => __( 'Product Price', 'beetan' ),
				'date'           => __( 'Published Date', 'beetan' ),
				'modified'       => __( 'Modified Date', 'beetan' ),
				'meta_value_num' => __( 'Popularity', 'beetan' ),
				'rand'           => __( 'Randomly', 'beetan' ),
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'enable_ajax_search', false ) && 'product' === beetan_get_option('beetan_search_post_type') ) {
					return true;
				}
				
				return false;
			}
		)
	)
);

/* Search result order */
$wp_customize->add_setting(
	'ajax_search_result_order',
	array(
		'default'           => beetan_default_option( 'ajax_search_result_order' ),
		'sanitize_callback' => 'beetan_sanitize_select',
	)
);
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'ajax_search_result_order',
		array(
			'label'           => __( 'Search Result Order', 'beetan' ),
			'section'         => 'products_search_settings_section',
			'type'            => 'select',
			'choices'         => array(
				'asc'  => __( 'Ascending Order', 'beetan' ),
				'desc' => __( 'Descending Order', 'beetan' )
			),
			'active_callback' => function () {
				if ( get_theme_mod( 'enable_ajax_search', false ) && 'product' === beetan_get_option('beetan_search_post_type') ) {
					return true;
				}
				
				return false;
			}
		)
	)
);