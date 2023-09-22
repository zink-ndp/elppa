<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Beetan
 */

// If plugin - 'WooCommerce' not exist then return.
if ( ! beetan_is_woocommerce_active() ) {
	return;
}

/**
 * Beetan WooCommerce Compatibility
 */
if ( ! class_exists( 'Beetan_Woocommerce' ) ) {
	
	class Beetan_Woocommerce {
		
		private static $instance;
		
		/**
		 * Initiator
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->includes();
			$this->hooks();
			
			do_action( 'beetan_woocommerce_loaded', $this );
		}
		
		/**
		 * Includes
		 */
		public function includes() {
			require_once get_template_directory() . '/inc/woocommerce/woocommerce-functions.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}
		
		/**
		 * Hooks
		 */
		public function hooks() {
			add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
			add_filter( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_action( 'wp', array( $this, 'woocommerce_init' ), 1 );
			add_action( 'wp', array( $this, 'woocommerce_product' ) );
			add_action( 'wp', array( $this, 'woocommerce_cart' ) );
			add_action( 'wp', array( $this, 'woocommerce_shop' ), 5 );
			add_action( 'wp', array( $this, 'woocommerce_checkout' ) );
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
			
			add_action( 'woocommerce_before_main_content', array( $this, 'woocommerce_wrapper_before' ) );
			add_action( 'woocommerce_after_main_content', array( $this, 'woocommerce_wrapper_after' ) );
			
			add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_toolbar_open' ) );
			add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );
			add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 25 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_layout_buttons' ), 30 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_toolbar_close' ), 40 );
			
			if ( beetan_get_option( 'enable_shop_archive_offcanvas_sidebar' ) ) {
				add_action( 'woocommerce_before_shop_loop', array( $this, 'shop_filter_button' ), 15 );
				add_action( 'beetan_before_sidebar_widgets', array( $this, 'shop_sidebar_close_button' ), 10 );
			}
			
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'woocommerce_cart_link_fragment' ) );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'beetan_get_sidebar', array( $this, 'replace_sidebar' ) );
			
			// Remove variations from the product title.
			add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
			add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );
			
			// Products load more ajax function
			if ( 'default' !== beetan_get_option( 'shop_pagination_type' ) ) {
				add_action( 'wp_ajax_beetan_shop_load_more_products', 'beetan_shop_load_more_products' );
				add_action( 'wp_ajax_nopriv_beetan_shop_load_more_products', 'beetan_shop_load_more_products' );
			}
			
			// Single product ajax add to cart.
			if ( get_theme_mod( 'enable_single_ajax_add_to_cart', true ) ) {
				// Ajax call helper function
				add_action( 'wc_ajax_beetan_single_ajax_add_to_cart', 'beetan_single_ajax_add_to_cart' );
				add_action( 'wc_ajax_nopriv_beetan_single_ajax_add_to_cart', 'beetan_single_ajax_add_to_cart' );
				
				// Remove WC Core add to cart handler to prevent double-add
				remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );
				
				// Add - add to cart new notice
				add_filter( 'woocommerce_add_to_cart_fragments', 'beetan_ajax_add_to_cart_add_fragments' );
			}
			
			// Ajax live search
			if ( get_theme_mod( 'enable_ajax_search', false ) && 'product' === get_theme_mod( 'beetan_search_post_type', 'product' ) ) {
				// Ajax call helper function
				add_action( 'wp_ajax_beetan_product_ajax_search', 'beetan_product_ajax_search' );
				add_action( 'wp_ajax_nopriv_beetan_product_ajax_search', 'beetan_product_ajax_search' );
			}
			
			add_action( 'woocommerce_before_mini_cart_contents', array( $this, 'free_shipping_status_bar' ) );
			
			// Sale Percentage
			add_filter( 'woocommerce_sale_flash', '__return_false' );
			add_action( 'woocommerce_shop_loop_item_title', 'beetan_product_sale_percentage', 8 );
		}
		
		public function shop_toolbar_open() {
			echo '<div class="beetan-shop-toolbar">';
		}
		
		public function shop_toolbar_close() {
			echo '</div>';
		}
		
		public function shop_filter_button() {
			if ( beetan_get_option( 'enable_shop_archive_offcanvas_sidebar' ) == false ) {
				return;
			}
   
			if ( is_shop() || is_product_taxonomy() ) {
				$shop_sidebar = beetan_get_option( 'archive_product_sidebar_position' );
				$shop_layout  = beetan_get_option( 'archive_product_container_layout' );
				
				if ( $shop_sidebar !== 'no_sidebar' && $shop_layout !== 'stretched' ) {
					echo '<div class="beetan-shop-filter">';
					echo '<a href="#" id="shop-filter-btn"><span class="material-icons">filter_alt</span> ' . esc_html__( 'Filter', 'beetan' ) . '</a>';
					echo '</div>';
				}
			}
		}
		
		public function shop_sidebar_close_button() {
            if ( beetan_get_option( 'enable_shop_archive_offcanvas_sidebar' ) == false ) {
                return;
            }
            
			if ( is_shop() || is_product_taxonomy() ) {
				echo '<button class="sidebar-close" id="sidebar-close"><span class="material-icons">close</span></button>';
			}
		}
		
		public function shop_layout_buttons() {
			if ( is_shop() || is_product_taxonomy() ) {
				echo '<nav class="beetan-shop-layout">';
				echo '<a href="#" class="shop-layout-btn list-view" id="list-view-btn"><span class="material-icons">format_list_bulleted</span></a>';
				echo '<a href="#" class="shop-layout-btn grid-view active" id="grid-view-btn"><span class="material-icons">grid_view</span></a>';
				echo '</nav>';
			}
		}
		
		/**
		 * WooCommerce setup theme
		 */
		public function setup_theme() {
			add_theme_support(
				'woocommerce',
				array(
					'thumbnail_image_width' => 150,
					'single_image_width'    => 300,
					'product_grid'          => array(
						'default_rows'    => 3,
						'min_rows'        => 1,
						'default_columns' => 4,
						'min_columns'     => 1,
						'max_columns'     => 6,
					),
				)
			);
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}
		
		/**
		 * WooCommerce specific scripts & stylesheets.
		 */
		public function enqueue_scripts() {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			
			wp_enqueue_style( 'beetan-woocommerce-style', esc_url( get_theme_file_uri( "/assets/css/woocommerce{$suffix}.css" ) ), array(), beetan_assets_version( "/assets/css/woocommerce{$suffix}.css" ) );
			
			$font_path   = WC()->plugin_url() . '/assets/fonts/';
			$inline_font = '@font-face {
                font-family: "star";
                src: url("' . $font_path . 'star.eot");
                src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                    url("' . $font_path . 'star.woff") format("woff"),
                    url("' . $font_path . 'star.ttf") format("truetype"),
                    url("' . $font_path . 'star.svg#star") format("svg");
                font-weight: normal;
                font-style: normal;
            }';
			
			wp_add_inline_style( 'beetan-woocommerce-style', $inline_font );
			
			wp_enqueue_script( 'beetan-woocommerce-scripts', esc_url( get_theme_file_uri( "/assets/js/woocommerce{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/woocommerce{$suffix}.js" ), true );
			
			wp_register_script( 'beetan-sticky-add-to-cart', esc_url( get_theme_file_uri( "/assets/js/sticky-add-to-cart{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/sticky-add-to-cart{$suffix}.js" ), true );
			wp_register_script( 'beetan-quantity-plus-minus', esc_url( get_theme_file_uri( "/assets/js/quantity-plus-minus{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/quantity-plus-minus{$suffix}.js" ), true );
			wp_register_script( 'beetan-mini-cart', esc_url( get_theme_file_uri( "/assets/js/mini-cart{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/mini-cart{$suffix}.js" ), true );
			wp_register_script( 'beetan-multistep-checkout', esc_url( get_theme_file_uri( "/assets/js/multistep-checkout{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/multistep-checkout{$suffix}.js" ), true );
			wp_register_script( 'jquery-validate', esc_url( get_theme_file_uri( "/assets/js/jquery.validate{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/jquery.validate{$suffix}.js" ), true );
			
			if ( is_product() && get_theme_mod( 'enable_single_ajax_add_to_cart', true ) ) {
				wp_enqueue_script( 'beetan-single-ajax-add-to-cart', esc_url( get_theme_file_uri( "/assets/js/single-ajax-add-to-cart{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/single-ajax-add-to-cart{$suffix}.js" ), true );
				wp_localize_script( 'beetan-single-ajax-add-to-cart', 'beetan_single_ajax_add_to_cart', array(
					'ajax_nonce' => wp_create_nonce( 'beetan_single_product_nonce' )
				) );
			}
			
			// Ajax live search script
			if ( get_theme_mod( 'enable_ajax_search', false ) && 'product' === get_theme_mod( 'beetan_search_post_type', 'product' ) ) {
				wp_enqueue_script( 'beetan-product-ajax-search', esc_url( get_theme_file_uri( "/assets/js/product-ajax-search{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/product-ajax-search{$suffix}.js" ), true );
				wp_localize_script( 'beetan-product-ajax-search', 'beetan_product_ajax_search', array(
					'ajax_nonce' => wp_create_nonce( 'beetan_product_ajax_search_nonce' ),
					'query_args' => array(
						'limit'   => get_theme_mod( 'ajax_search_result_limit', 5 ),
						'orderby' => get_theme_mod( 'ajax_search_result_order_by', 'title' ),
						'order'   => get_theme_mod( 'ajax_search_result_order', 'asc' ),
					)
				) );
			}
			
			// Shop load more products script
			if ( 'default' !== beetan_get_option( 'shop_pagination_type' ) && ( is_shop() || is_product_taxonomy() ) ) {
				global $wp_query;
				
				wp_enqueue_script( 'beetan-shop-load-more-products', esc_url( get_theme_file_uri( "/assets/js/shop-load-more-products{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/shop-load-more-products{$suffix}.js" ), true );
				wp_localize_script( 'beetan-shop-load-more-products', 'beetan_shop_load_more_products', array(
					'ajax_nonce'         => wp_create_nonce( 'beetan_shop_load_more_products_nonce' ),
					'ajax_url'           => admin_url( 'admin-ajax.php' ),
					'posts'              => json_encode( $wp_query->query_vars ),
					'current_page'       => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
					'max_page'           => $wp_query->max_num_pages,
					'btn_load_more_text' => esc_html__( 'Load More', 'beetan' ),
					'btn_loading_text'   => esc_html__( 'Loading ...', 'beetan' ),
				) );
			}
		}
		
		/**
		 * Add 'woocommerce-active' class to the body tag.
		 *
		 * @param $classes
		 *
		 * @return mixed
		 */
		public function body_class( $classes ) {
			$classes[] = 'woocommerce-active';
			
			// Add shop offcanvas sidebar class
			if ( beetan_get_option( 'enable_shop_archive_offcanvas_sidebar' ) && ( is_shop() || is_product_taxonomy() ) ) {
				$classes[] = 'shop-offcanvas-sidebar';
			}
			
			if ( is_shop() || is_product_taxonomy() ) {
				$classes[] = 'shop-pagination-type-' . beetan_get_option( 'shop_pagination_type' );
			}
			
			// Add quantity plus/minus class
			if ( beetan_get_option( 'product_quantity_plus_minus_button' ) ) {
				$classes[] = 'qty-button-' . get_theme_mod( 'product_quantity_input_style', 'style-2' );
			}
			
			// Add mini cart class
			if ( beetan_get_option( 'enable_mini_cart' ) ) {
				$classes[] = 'mini-cart-' . get_theme_mod( 'mini_cart_layout', 'dropdown' );
			}
			
			// Add single product page class
			if ( is_product() ) {
				// Add sticky product summary class
				if ( beetan_get_option( 'sticky_product_summary' ) ) {
					$classes[] = 'sticky-product-summary';
				}
			}
			
			// Add cart page class
			if ( is_cart() ) {
				$classes[] = 'cart-' . beetan_get_option( 'shop_cart_layout' );
				
				// Add cart total sticky class
				if ( beetan_get_option( 'sticky_cart_totals' ) && 'layout-2' === beetan_get_option( 'shop_cart_layout' ) ) {
					$classes[] = 'sticky-cart-totals';
				}
				
				// Add cart auto update class
				if ( beetan_get_option( 'cart_auto_update' ) ) {
					$classes[] = 'cart-auto-update';
				}
			}
			
			// Add checkout page class
			if ( is_checkout() ) {
				$classes[] = 'checkout-' . beetan_get_option( 'shop_checkout_layout' );
				
				// Add sticky order summary
				if ( beetan_get_option( 'sticky_checkout_order_summary' ) && 'layout-2' === beetan_get_option( 'shop_checkout_layout' ) ) {
					$classes[] = 'sticky-order-summary';
				}
				
				if ( beetan_get_option( 'enable_distraction_free_checkout' ) ) {
					$classes[] = 'distraction-free-checkout';
				}
			}
			
			return $classes;
		}
		
		/**
		 * Remove WooCommerce Default Actions
		 */
		public function woocommerce_init() {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		}
		
		/**
		 * WooCommerce Single Product Page Customization
		 */
		public function woocommerce_product() {
			if ( ! is_product() ) {
				return;
			}
			
			// Remove upsells
			if ( ! get_theme_mod( 'enable_upsells', true ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}
			
			// Remove related products
			if ( ! get_theme_mod( 'enable_related_products', true ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}
			
			// Remove Breadcrumb
			if ( ! get_theme_mod( 'enable_single_product_breadcrumb', true ) ) {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			}
			
			// Sticky add to cart
			if ( get_theme_mod( 'sticky_add_to_cart', true ) ) {
				// Add JS script
				wp_enqueue_script( 'beetan-sticky-add-to-cart' );
				
				// Add sticky add to cart markup
				add_action( 'wp_footer', 'beetan_sticky_add_to_cart' );
			}
			
			// Add payment icons
			if ( in_array( 'single-product', get_theme_mod( 'payment_icons_placement', beetan_default_option( 'payment_icons_placement' ) ) ) ) {
				add_action( 'woocommerce_product_meta_end', 'beetan_payment_icons_section', 10 );
			}
		}
		
		/**
		 * WooCommerce Shop Product Customization
		 */
		public function woocommerce_shop() {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10 );
			add_action( 'woocommerce_shop_loop_item_title', 'beetan_shop_product_title', 10 );
			// add_action( 'woocommerce_shop_loop_item_title', 'beetan_product_sale_percentage', 8 );
			add_action( 'woocommerce_shop_loop_item_title', 'beetan_product_brand', 9 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'beetan_shop_product_img_overlay', 20 );
			add_action( 'beetan_shop_thumbnail_overlay_content', 'beetan_shop_item_view_details_button', 15 );
			add_filter( 'woocommerce_pagination_args', 'beetan_change_shop_pagination_arrow' );
			
			// Mini Cart
			if ( get_theme_mod( 'enable_mini_cart', true ) ) {
				wp_enqueue_script( 'beetan-mini-cart' );
			}
			
			// Enable Quantity +/- button
			if ( get_theme_mod( 'product_quantity_plus_minus_button', true ) ) {
				wp_enqueue_script( 'beetan-quantity-plus-minus' );
				
				add_action( 'woocommerce_after_quantity_input_field', 'beetan_product_quantity_button' );
			}
			
			// Shop title
			if ( ! beetan_get_option( 'enable_shop_archive_title' ) && is_shop() ) {
				add_filter( 'woocommerce_show_page_title', '__return_false' );
			}
			
			// Shop breadcrumb
			if ( ! beetan_get_option( 'enable_shop_archive_breadcrumb' ) && ( is_shop() || is_product_taxonomy() ) ) {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
			}
			
			// Shop result count
			if ( ! beetan_get_option( 'enable_shop_archive_result_count' ) ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 25 );
			}
			
			// Shop product sorting dropdown
			if ( ! beetan_get_option( 'enable_shop_archive_product_sorting' ) ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );
			}
			
			// Shop product view layout button
			if ( ! beetan_get_option( 'enable_shop_archive_product_view' ) ) {
				remove_action( 'woocommerce_before_shop_loop', array( $this, 'shop_layout_buttons' ), 30 );
			}
			
			if ( 'default' !== beetan_get_option( 'shop_pagination_type' ) ) {
				// Remove Woocommerce pagination as we do not need it anymore
				remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
				
				// Add Load More button
				add_action( 'woocommerce_after_shop_loop', 'beetan_shop_load_more_button' );
			}
			
			if ( defined( 'YITH_WCQV' ) ) {
				remove_action( 'woocommerce_after_shop_loop_item', array(
					YITH_WCQV_Frontend(),
					'yith_add_quick_view_button'
				), 15 );
				add_action( 'beetan_shop_thumbnail_overlay_content', array(
					YITH_WCQV_Frontend(),
					'yith_add_quick_view_button'
				), 10 );
			}
			
			// Swatches Pro compatibility
			wp_enqueue_script( 'woo-variation-swatches-pro' );
		}
		
		/**
		 * WooCommerce Checkout Page
		 */
		public function woocommerce_checkout() {
			if ( ! is_checkout() ) {
				return;
			}
			
			// Remove Apply Coupon field
			if ( ! get_theme_mod( 'enable_apply_coupon', true ) ) {
				remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
			}
			
			// Remove Order Notes field
			if ( ! get_theme_mod( 'enable_order_notes', true ) ) {
				add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );
			}
			
			// Multistep checkout
			if ( beetan_is_multistep_checkout() ) {
				// Add JS script
				wp_enqueue_script( 'beetan-multistep-checkout' );
				wp_enqueue_script( 'jquery-validate' );
				
				// Remove default checkout template.
				remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
				remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
				remove_action( 'woocommerce_checkout_before_customer_details', 'wc_get_pay_buttons', 30 );
				
				// Multistep progress bar
				add_action( 'beetan_before_page_entry_content', 'beetan_multistep_checkout_header' );
				
				// Start Multistep Checkout Wrap
				add_action( 'woocommerce_checkout_before_customer_details', 'beetan_multistep_checkout_wrap_start', 10 );
				
				// First step wrap
				add_action( 'woocommerce_checkout_before_customer_details', 'beetan_multistep_checkout_first_step_wrap_start', 20 );
				add_action( 'woocommerce_checkout_after_customer_details', 'beetan_multistep_checkout_first_step_wrap_end', 10 );
				
				// Second step wrap
				add_action( 'woocommerce_checkout_after_customer_details', 'beetan_multistep_checkout_second_step_wrap', 20 );
				
				// Third step wrap
				add_action( 'woocommerce_checkout_after_customer_details', 'beetan_multistep_checkout_third_step_wrap', 30 );
				
				// Third step content
				add_action( 'beetan_multistep_checkout_third_step', 'woocommerce_checkout_payment', 10 );
				add_action( 'beetan_multistep_checkout_third_step', 'wc_get_pay_buttons', 40 );
				
				// End Multistep Checkout Wrap
				add_action( 'woocommerce_checkout_after_customer_details', 'beetan_multistep_checkout_wrap_end', 100 );
			}
		}
		
		/**
		 * WooCommerce Cart Page
		 */
		public function woocommerce_cart() {
			if ( ! is_cart() ) {
				return;
			}
			
			// Hide cart page coupon form
			if ( get_theme_mod( 'hide_coupon_cart_page', false ) ) {
				add_filter( 'woocommerce_coupons_enabled', '__return_false' );
			}
			
			// Add payment icons
			if ( in_array( 'cart-sidebar', get_theme_mod( 'payment_icons_placement', beetan_default_option( 'payment_icons_placement' ) ) ) ) {
				add_action( 'woocommerce_proceed_to_checkout', 'beetan_payment_icons_section', 9 );
			}
			
			// Change cart page `Proceed to Checkout` button text
			if ( ! empty( get_theme_mod( 'proceed_to_checkout_button_text' ) ) && get_theme_mod( 'change_proceed_to_checkout_button_text', false ) ) {
				remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
				add_action( 'woocommerce_proceed_to_checkout', 'beetan_button_proceed_to_checkout', 20 );
			}
			
			// Remove cart page cross-sells from default position
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			
			// Cart cross-sell
			if ( get_theme_mod( 'enable_cart_cross_sells', true ) ) {
				// Add cart page cross-sells UNDER the cart table
				if ( 'layout-2' === get_theme_mod( 'shop_cart_layout', 'layout-1' ) && get_theme_mod( 'sticky_cart_totals' ) ) {
					add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );
				} else {
					add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
				}
				
				// Cross-sells columns
				add_filter( 'woocommerce_cross_sells_columns', function ( $columns ) {
					return get_theme_mod( 'cart_cross_sells_columns', 3 );
				} );
				
				// Cross-sells products limit
				add_filter( 'woocommerce_cross_sells_total', function ( $limit ) {
					return get_theme_mod( 'cart_cross_sells_products_limit', 3 );
				} );
			}
		}
		
		/**
		 * WooCommerce Before Content Wrapper.
		 *
		 * @return void
		 */
		public function woocommerce_wrapper_before() {
			echo '<section class="content-area">';
			
			if ( 'left_sidebar' == beetan_sidebar_layout() ) {
				get_sidebar();
			}
			
			echo '<main id="primary" class="site-main">';
		}
		
		/**
		 * WooCommerce After Content Wrapper.
		 *
		 * @return void
		 */
		public function woocommerce_wrapper_after() {
			echo '</main><!-- #main -->';
			
			if ( 'right_sidebar' == beetan_sidebar_layout() ) {
				get_sidebar();
			}
			
			echo '</section>';
		}
		
		public function register_widgets() {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Shop Sidebar', 'beetan' ),
					'id'            => 'sidebar-product-archive',
					/* translators: widget description */
					'description'   => sprintf( __( 'Add widgets here to show in single product page sidebar. Make sure you have enabled Sidebar layout by going to <a href="%1$s"><strong>Appearance / Customizer / Sidebar Options.</strong></a>', 'beetan' ), esc_url( admin_url( 'customize.php?autofocus%5Bsection%5D=sidebar_settings_section' ) ) ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
			register_sidebar(
				array(
					'name'          => esc_html__( 'Single Product Sidebar', 'beetan' ),
					'id'            => 'sidebar-product',
					/* translators: widget description */
					'description'   => sprintf( __( 'Add widgets here to show in shop page sidebar. Make sure you have enabled Sidebar layout by going to <a href="%1$s"><strong>Appearance / Customizer / Sidebar Options.</strong></a>', 'beetan' ), esc_url( admin_url( 'customize.php?autofocus%5Bsection%5D=sidebar_settings_section' ) ) ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}
		
		/**
		 * Related Products Args.
		 *
		 * @param array $args related products args.
		 *
		 * @return array $args related products args.
		 */
		public function related_products_args( $args ) {
			$shop_grid = get_option( 'woocommerce_catalog_columns', 4 );
			$defaults  = array(
				'posts_per_page' => absint( $shop_grid ),
				'columns'        => absint( $shop_grid ),
			);
			
			$args = wp_parse_args( $defaults, $args );
			
			return $args;
		}
		
		/**
		 * Cart Fragments.
		 *
		 * Ensure cart contents update when products are added to the cart via AJAX.
		 *
		 * @param $fragments
		 *
		 * @return mixed
		 */
		public function woocommerce_cart_link_fragment( $fragments ) {
			ob_start();
			$this->woocommerce_cart_link();
			$fragments['a.cart-contents'] = ob_get_clean();
			
			return $fragments;
		}
		
		/**
		 * Cart Link.
		 *
		 * Displayed a link to the cart including the number of items present and the cart total.
		 *
		 * @return void
		 */
		public function woocommerce_cart_link() {
			$item_count = WC()->cart->get_cart_contents_count();
			?>
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="site-navigation-right__item cart-contents"
               title="<?php esc_attr_e( 'View your shopping cart', 'beetan' ); ?>">
                <span class="material-icons">shopping_cart</span>
				
				<?php if ( 1 <= $item_count ) { ?>
                    <span class="status count"><?php echo esc_html( $item_count ); ?></span>
				<?php } ?>
            </a>
			<?php
		}
		
		/**
		 * Custom mini cart
		 *
		 * @return false|string
		 */
		public function woocommerce_mini_cart() {
			ob_start();
			?>
            <li class="site-mini-cart">
				<?php $this->woocommerce_cart_link(); ?>

                <div class="site-mini-cart__<?php echo esc_attr( get_theme_mod( 'mini_cart_layout', 'dropdown' ) ); ?>">
					<?php
					$instance = array(
						'title' => '',
					);
					
					the_widget( 'WC_Widget_Cart', $instance );
					?>
                </div>
            </li>
			<?php
			return ob_get_clean();
		}
		
		/**
		 * Assign shop sidebar for store page.
		 */
		public function replace_sidebar( $sidebar ) {
			if ( is_shop() || is_product_taxonomy() ) {
				$sidebar = 'sidebar-product-archive';
			} elseif ( is_product() ) {
				$sidebar = 'sidebar-product';
			}
			
			return $sidebar;
		}
		
		/**
		 * Free shipping status bar
		 */
		public function free_shipping_status_bar() {
			$min_amount     = $this->get_free_shipping_min_amount();
			$current_amount = WC()->cart->subtotal;
			
			if ( $current_amount < $min_amount ) {
				$remaining = $min_amount - $current_amount;
				$percent   = 100 - ( $remaining / $min_amount ) * 100;
				
				printf( '<div class="free-shipping-status-bar">' . esc_html__( 'You\'re %s  Away From FREE Shipping!', 'beetan' ) . '<span class="percent-progress" style="width: %s"></span></div>', wc_price( $min_amount - $current_amount ), esc_attr( $percent . '%' ) );
			} elseif ( $current_amount >= $min_amount ) {
				printf( '<div class="free-shipping-status-bar">%s</div>', esc_html__( 'You Have Now FREE Shipping! &#x1F389;', 'beetan' ) );
			}
		}
		
		/**
		 * Get free shipping minimum amount threshold
		 */
		public function get_free_shipping_min_amount() {
			$shipping_packages = WC()->cart->get_shipping_packages();
			$shipping_package  = reset( $shipping_packages );
			$shipping_zone     = wc_get_shipping_zone( $shipping_package );
			$min_amount        = null;
			
			foreach ( $shipping_zone->get_shipping_methods( true ) as $method ) {
				if ( $method->id === 'free_shipping' ) {
					$instance   = isset( $method->instance_settings ) ? $method->instance_settings : null;
					$min_amount = isset( $instance['min_amount'] ) ? $instance['min_amount'] : null;
				}
			}
			
			return $min_amount;
		}
	}
}

Beetan_Woocommerce::instance();


