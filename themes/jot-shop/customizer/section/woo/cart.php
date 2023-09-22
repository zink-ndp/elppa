<?php
if ( ! class_exists( 'WooCommerce' ) ){
    return;
}
/***************/
// Cart
/***************/

// cross sell product divider
$wp_customize->add_setting('jot_shop_divide_woo_cross_sell', array(
        'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control( new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_divide_woo_cross_sell',
            array(
        'section'     => 'jot-shop-woo-cart-page',
        'type'        => 'custom_message',
        'description' => wp_kses_post('Cross Sell Product','jot-shop' ),
        'priority'    => 2,
)));
// cross sell product column
if ( class_exists( 'Jot_Shop_WP_Customizer_Range_Value_Control' ) ){
$wp_customize->add_setting(
            'jot_shop_cross_num_col_shw', array(
                'sanitize_callback' => 'jot_shop_sanitize_range_value',
                'default' => '2',
                
                
            )
        );
$wp_customize->add_control(
            new Jot_Shop_WP_Customizer_Range_Value_Control(
                $wp_customize, 'jot_shop_cross_num_col_shw', array(
                    'label'       => __( 'Number Of Column To Show', 'jot-shop' ),
                    'section'     => 'jot-shop-woo-cart-page',
                    'type'        => 'range-value',
                    'input_attr'  => array(
                        'min'  => 1,
                        'max'  => 3,
                        'step' => 1,
                    ),
                    
                )
        )
);
// no.of product to show
$wp_customize->add_setting(
              'jot_shop_cross_num_product_shw', array(
                'sanitize_callback' => 'jot_shop_sanitize_range_value',
                'default' => '4',       
            )
        );
$wp_customize->add_control(
            new Jot_Shop_WP_Customizer_Range_Value_Control(
                $wp_customize, 'jot_shop_cross_num_product_shw', array(
                    'label'       => __( 'Number Of Product To Show', 'jot-shop' ),
                    'section'     => 'jot-shop-woo-cart-page',
                    'type'        => 'range-value',
                    'input_attr'  => array(
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    
                )
          )
   );
}

/****************/
// doc link
/****************/
$wp_customize->add_setting('jot_shop_cart_link_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_cart_link_more',
            array(
        'section'     => 'jot-shop-woo-cart-page',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop/#cart-page',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));