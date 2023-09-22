<?php
if ( ! function_exists( 'beetan_set_wc_session' ) ) {
	/**
	 * Set WooCommerce Session
	 *
	 * @param $name
	 * @param $value
	 */
	function beetan_set_wc_session( $name, $value ) {
		if ( ! did_action( 'woocommerce_init' ) ) {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'This function should not be called before woocommerce_init.', 'beetan' ), '2.6' );
			
			return;
		}
		
		if ( ! isset( WC()->session ) ) {
			return;
		}
		
		$get_session_cookie = WC()->session->get_session_cookie();
		
		if ( empty( $get_session_cookie ) ) {
			WC()->session->set_customer_session_cookie( true );
		}
		
		WC()->session->set( $name, $value );
	}
}

if ( ! function_exists( 'beetan_get_wc_session' ) ) {
	/**
	 * Get WooCommerce Session
	 *
	 * @param $name
	 *
	 * @return array|string
	 */
	function beetan_get_wc_session( $name ) {
		if ( ! did_action( 'woocommerce_init' ) ) {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'This function should not be called before woocommerce_init.', 'beetan' ), '2.3' );
			
			return '';
		}
		
		if ( ! isset( WC()->session ) ) {
			return '';
		}
		
		return WC()->session->get( $name );
	}
}

if ( ! function_exists( 'beetan_delete_wc_session' ) ) {
	/**
	 * Delete WooCommerce Session
	 *
	 * @param $name
	 *
	 * @return string|void
	 */
	function beetan_delete_wc_session( $name ) {
		if ( ! did_action( 'woocommerce_init' ) ) {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'This function should not be called before woocommerce_init.', 'beetan' ), '2.3' );
			
			return '';
		}
		
		if ( ! isset( WC()->session ) ) {
			return '';
		}
		
		WC()->session->set( $name, null );
	}
}

if ( ! function_exists( 'beetan_wc_get_currencies' ) ) {
	/**
	 * WooCommerce Get Currency list
	 *
	 * @return array
	 */
	function beetan_wc_get_currencies() {
		$currency_code_options = (array) get_woocommerce_currencies();
		
		foreach ( $currency_code_options as $code => $name ) {
			// $currency_code_options[ $code ] = sprintf( '%s ( %s )', $name, get_woocommerce_currency_symbol( $code ) );
			$currency_code_options[ $code ] = html_entity_decode( sprintf( '%s ( %s )', $name, get_woocommerce_currency_symbol( $code ) ) );
		}
		
		return $currency_code_options;
	}
}

if ( ! function_exists( 'beetan_wc_get_currency_position' ) ) {
	/**
	 * WooCommerce Get Currency icon position
	 *
	 * @return array
	 */
	function beetan_wc_get_currency_position() {
		$currency_symbol = html_entity_decode( get_woocommerce_currency_symbol() );
		
		return array(
			'left'        => sprintf( esc_html__( 'Left (%s99.99)', 'beetan' ), $currency_symbol ),
			// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			'right'       => sprintf( esc_html__( 'Right (99.99%s)', 'beetan' ), $currency_symbol ),
			// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			'left_space'  => sprintf( esc_html__( 'Left with space (%s 99.99)', 'beetan' ), $currency_symbol ),
			// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			'right_space' => sprintf( esc_html__( 'Right with space (99.99 %s)', 'beetan' ), $currency_symbol )
			// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		);
	}
}

if ( ! function_exists( 'beetan_single_ajax_add_to_cart' ) ) {
	/**
	 * Single product ajax add to cart
	 */
	function beetan_single_ajax_add_to_cart() {
		check_ajax_referer( 'beetan_single_product_nonce', 'ajax_nonce' );
		
		WC_Form_Handler::add_to_cart_action();
		WC_AJAX::get_refreshed_fragments();
	}
}

if ( ! function_exists( 'beetan_ajax_add_to_cart_add_fragments' ) ) {
	/**
	 * Notice html to cart fragments
	 *
	 * @param $fragments
	 *
	 * @return mixed
	 */
	function beetan_ajax_add_to_cart_add_fragments( $fragments ) {
		$all_notices  = WC()->session->get( 'wc_notices', array() );
		$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );
		
		ob_start();
		
		foreach ( $notice_types as $notice_type ) {
			if ( wc_notice_count( $notice_type ) > 0 ) {
				wc_get_template( "notices/{$notice_type}.php", array(
					'messages' => array_filter( $all_notices[ $notice_type ] ),
					'notices'  => array_filter( $all_notices[ $notice_type ] ),
				) );
			}
		}
		
		$fragments['notices_html'] = ob_get_clean();
		wc_clear_notices();
		
		return $fragments;
	}
}

if ( ! function_exists( 'beetan_product_ajax_search' ) ) {
	/**
	 * Product ajax  search
	 */
	function beetan_product_ajax_search() {
		check_ajax_referer( 'beetan_product_ajax_search_nonce', 'ajax_nonce' );
		
		$search_key = isset( $_POST['search_key'] ) ? sanitize_text_field( wp_unslash( $_POST['search_key'] ) ) : '';
		$limit      = isset( $_POST['limit'] ) ? absint( $_POST['limit'] ) : 5;
		$orderby    = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : 'title';
		$order      = isset( $_POST['order'] ) ? sanitize_text_field( wp_unslash( $_POST['order'] ) ) : 'asc';
		
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => $limit,
			's'              => $search_key,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_status'    => array( 'publish' )
		);
		
		if ( $orderby === 'price' ) {
			$args['meta_key'] = '_price';
		}
		
		if ( $orderby === 'meta_value_num' ) {
			$args['meta_key'] = 'total_sales';
		}
		
		$html     = '';
		$products = new WP_Query( $args );
		
		if ( $products->have_posts() && ! empty( $search_key ) ) {
			while ( $products->have_posts() ) {
				$products->the_post();
				$id = get_the_ID();
				
				ob_start();
				
				$product   = wc_get_product( $id );
				$title     = get_the_title( $id );
				$image     = wp_get_attachment_image( $product->get_image_id() );
				$permalink = get_the_permalink( $id );
				$price     = $product->get_price_html();
				?>

                <a href="<?php echo esc_url( $permalink ); ?>" class="beetan-ajax-search__item">
					<?php if ( $image ) { ?>
                        <div class="beetan-ajax-search__item-image">
							<?php echo wp_kses_post( $image ); ?>
                        </div>
					<?php } ?>

                    <div class="beetan-ajax-search__item-details">
                        <h5 class="beetan-ajax-search__item-title"><?php echo esc_html( $title ); ?></h5>

                        <div class="beetan-ajax-search__item-price">
							<?php echo wp_kses_post( $price ); ?>
                        </div>
                    </div>
                </a>
				
				<?php
				$html .= ob_get_clean();
			}
		}
		
		if ( empty( $html ) && ! empty( $search_key ) ) {
			$html .= '<p class="beetan-ajax-search__no-results">' . esc_html__( 'No product found.', 'beetan' ) . '</p>';
		}
		
		wp_send_json( array(
			'status' => 'success',
			'output' => wp_kses_post( $html )
		) );
	}
}

if ( ! function_exists( 'beetan_shop_load_more_button' ) ) {
	/**
	 * Shop load more button
	 */
	function beetan_shop_load_more_button() {
		global $wp_query;
		
		$pages          = $wp_query->max_num_pages;
		$post_count     = $wp_query->post_count;
		$current_page   = get_query_var( 'paged' );
		$posts_per_page = get_query_var( 'posts_per_page' );
		$loading_type   = beetan_get_option( 'shop_pagination_type' );
        
        if ( $posts_per_page > $post_count ) {
            return;
        }
		
		if ( woocommerce_products_will_display() && $current_page < $pages ) {
			?>
            <div class="beetan-shop-load-more" data-loading_type="<?php echo esc_attr( $loading_type ); ?>">
                <button class="shop-load-more-btn"><span
                            class="shop-load-more-btn-label"><?php echo esc_html__( 'Load More', 'beetan' ); ?></span>
                </button>
                
                <span class="beetan-products-loading-status"></span>
            </div>
			<?php
		}
	}
}

if ( ! function_exists( 'beetan_shop_load_more_products' ) ) {
	/**
	 * Shop load more products
	 */
	function beetan_shop_load_more_products() {
		check_ajax_referer( 'beetan_shop_load_more_products_nonce', 'ajax_nonce' );
		
		$args                = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged']       = $_POST['page'] + 1;
		$args['post_status'] = 'publish';
		
		$the_query = new WP_Query( $args );
		
		ob_start();
		
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				wc_get_template_part( 'content', 'product' );
			};
		}
		
		wp_reset_postdata();
		
		$html = ob_get_contents();
		
		ob_get_clean();
		
		wp_send_json_success( $html );
		
		die();
	}
}

if ( ! function_exists( 'beetan_product_quantity_button' ) ) {
	/**
	 * Product quantity plus minus button
	 */
	function beetan_product_quantity_button() {
		$class = 'qty-' . get_theme_mod( 'product_quantity_input_style', 'style-1' );
		
		echo '<div class="beetan-quantity-buttons ' . esc_attr( $class ) . '">';
		echo '<a href="#" class="quantity-minus" role="button">' . esc_html( '-' ) . '</a>';
		echo '<a href="#" class="quantity-plus" role="button">' . esc_html( '+' ) . '</a>';
		echo '</div>';
	}
}

if ( ! function_exists( 'beetan_product_sale_percentage' ) ) {
	/**
	 * Product discount percentage
	 */
	function beetan_product_sale_percentage() {
		global $product;
		
		$percentages  = array();
		$product_type = $product->get_type();
		$is_on_sale   = $product->is_on_sale();
		
		if ( ! $is_on_sale ) {
			return false;
		}
		
		if ( 'variable' == $product_type ) {
			$prices = $product->get_variation_prices();
			
			foreach ( $prices['price'] as $key => $price ) {
				// Only on sale variations
				if ( $prices['regular_price'][ $key ] !== $price ) {
					$percentages[] = round( 100 - ( floatval( $prices['sale_price'][ $key ] ) / floatval( $prices['regular_price'][ $key ] ) * 100 ) );
				}
			}
			
			// Keep the highest value
			$percentage = max( $percentages ) . '%';
		} elseif ( 'grouped' == $product_type ) {
			$children_ids = $product->get_children();
			
			foreach ( $children_ids as $child_id ) {
				$child_product = wc_get_product( $child_id );
				$regular_price = (float) $child_product->get_regular_price();
				$sale_price    = (float) $child_product->get_sale_price();
				
				if ( $sale_price != 0 || ! empty( $sale_price ) ) {
					$percentages[] = round( 100 - ( $sale_price / $regular_price * 100 ) );
				}
			}
			
			// Keep the highest value
			$percentage = max( $percentages ) . '%';
		} else {
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();
			
			if ( $sale_price != 0 || ! empty( $sale_price ) ) {
				$percentage = round( 100 - ( $sale_price / $regular_price * 100 ) ) . '%';
			} else {
				return false;
			}
		}
		
		return printf( '<span class="sales-badge sale-percentage">%s%s</span>', absint( $percentage ), esc_html__( '% OFF', 'beetan' ) );
	}
}

if ( ! function_exists( 'beetan_product_brand' ) ) {
	function beetan_product_brand() {
		$brand_obj = wp_get_object_terms( get_the_ID(), 'product_brand' );
		
		if ( is_wp_error( $brand_obj ) ) {
			return;
		}
		
		if ( ! empty( $brand_obj ) ) {
			$brand_array = wp_list_pluck( $brand_obj, 'name' );
			$brand_name  = implode( ',', $brand_array );
			
			echo '<span class="product_brand">' . esc_html( $brand_name ) . '</span>';
		}
	}
}

if ( class_exists( 'Woo_Variation_Gallery' ) ) {
	/**
	 * Additional Variation Image Gallery plugin compatible
	 */
	add_filter( 'woo_variation_gallery_default_width', function ( $width ) {
		$width = 48;
		
		return $width;
	} );
}

if ( ! function_exists( 'beetan_shop_product_title' ) ) {
	/**
	 * Shop product title
	 */
	function beetan_shop_product_title() {
		echo '<a href="' . esc_url( get_the_permalink() ) . '">';
		woocommerce_template_loop_product_title();
		echo '</a>';
	}
}

if ( ! function_exists( 'beetan_shop_product_img_overlay' ) ) {
	/**
	 * Shop thumbnail overlay
	 */
	function beetan_shop_product_img_overlay() {
		echo '<div class="beetan-shop-thumbnail-overlay">';
		
		do_action( 'beetan_shop_thumbnail_overlay_content', get_the_ID() );
		
		echo '</div>';
	}
}

if ( ! function_exists( 'beetan_shop_item_view_details_button' ) ) {
	/**
	 * Shop view details button
	 */
	function beetan_shop_item_view_details_button() {
		printf( '<a href="%s" class="button view-details">%s</a>', esc_url( get_the_permalink() ), esc_html__( 'View Details', 'beetan' ) );
	}
}

if ( ! function_exists( 'beetan_change_shop_pagination_arrow' ) ) {
	/**
	 * Change shop page pagination arrow
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	function beetan_change_shop_pagination_arrow( $args ) {
		$args['prev_text'] = '<span class="material-icons">navigate_before</span>';
		$args['next_text'] = '<span class="material-icons">navigate_next</span>';
		
		return $args;
	}
}

if ( ! function_exists( 'beetan_button_proceed_to_checkout' ) ) {
	/**
	 * Change cart page `Proceed to Checkout` button text
	 */
	function beetan_button_proceed_to_checkout() {
		$button_text = get_theme_mod( 'proceed_to_checkout_button_text' );
		
		if ( ! empty( $button_text ) ) {
			printf( '<a href="%s" class="checkout-button button alt wc-forward">%s</a>', esc_url( wc_get_checkout_url() ), esc_html( $button_text ) );
		}
	}
}

if ( ! function_exists( 'beetan_order_review_wrap_before' ) ) {
	/**
	 * Checkout wrapper
	 */
	function beetan_order_review_wrap_before() {
		echo '<div class="checkout-order-review-wrapper">';
	}
}
add_action( 'woocommerce_checkout_before_order_review_heading', 'beetan_order_review_wrap_before', 5 );

if ( ! function_exists( 'beetan_order_review_wrap_after' ) ) {
	/**
	 * Checkout wrapper end
	 */
	function beetan_order_review_wrap_after() {
		echo '</div>';
	}
}
add_action( 'woocommerce_checkout_after_order_review', 'beetan_order_review_wrap_after', 15 );

if ( ! function_exists( 'beetan_is_multistep_checkout' ) ) {
	/**
	 * Detect multistep checkout page
	 */
	function beetan_is_multistep_checkout() {
		if ( ! beetan_is_woocommerce_active() ) {
			return false;
		}
		
		return ( is_checkout() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) && ( 'layout-3' === get_theme_mod( 'shop_checkout_layout' ) ) );
	}
}

if ( ! function_exists( 'beetan_multistep_checkout_header' ) ) {
	/**
	 * Multistep checkout header markup
	 */
	function beetan_multistep_checkout_header() {
		$disable_multistep = apply_filters( 'beetan_disable_multistep_checkout', false );
		
		if ( $disable_multistep || ! beetan_is_multistep_checkout() ) {
			return;
		}
		?>
        <div class="multistep-checkout-progress">
            <span class="multistep-item active" data-step="billing">
                <span class="item-text"><?php echo esc_html__( 'Billing & Shipping', 'beetan' ); ?></span>
            </span>

            <span class="multistep-item" data-step="order">
                <span class="item-text"><?php echo esc_html__( 'Order', 'beetan' ); ?></span>
            </span>

            <span class="multistep-item" data-step="payment">
                <span class="item-text"><?php echo esc_html__( 'Payment', 'beetan' ); ?></span>
            </span>
        </div>
		<?php
	}
}

if ( ! function_exists( 'beetan_multistep_checkout_wrap_start' ) ) {
	/**
	 * Multistep checkout wrap start
	 */
	function beetan_multistep_checkout_wrap_start() {
		echo '<section class="multistep-checkout-wrap">';
	}
}

if ( ! function_exists( 'beetan_multistep_checkout_wrap_end' ) ) {
	/**
	 * Multistep checkout wrap end
	 */
	function beetan_multistep_checkout_wrap_end() {
		echo '</section>';
	}
}

if ( ! function_exists( 'beetan_multistep_checkout_first_step_wrap_start' ) ) {
	/**
	 * Multistep checkout first step start
	 */
	function beetan_multistep_checkout_first_step_wrap_start() {
		echo '<div class="multistep-checkout-content active" data-step="billing">';
		
		do_action( 'beetan_multistep_checkout_first_step' );
	}
}

if ( ! function_exists( 'beetan_multistep_checkout_first_step_wrap_end' ) ) {
	/**
	 * Multistep checkout first step end
	 */
	function beetan_multistep_checkout_first_step_wrap_end() {
		?>
        <div class="multistep-checkout-navigation">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="back-to-cart"><span
                        class="material-icons">west</span><?php echo esc_html__( 'Back to Cart', 'beetan' ); ?></a>
            <a href="#" class="multistep-checkout-next"
               data-target="order"><?php echo esc_html__( 'Next Step', 'beetan' ); ?><span
                        class="material-icons">east</span></a>
        </div>
		<?php
		
		echo '</div>';
	}
}

if ( ! function_exists( 'beetan_multistep_checkout_second_step_wrap' ) ) {
	/**
	 * Multistep checkout second step start
	 */
	function beetan_multistep_checkout_second_step_wrap() {
		echo '<div class="multistep-checkout-content" data-step="order">';
		
		do_action( 'beetan_multistep_checkout_second_step' );
		
		?>
        <div class="multistep-checkout-navigation">
            <a href="#" class="multistep-checkout-prev" data-target="billing"><span
                        class="material-icons">west</span><?php echo esc_html__( 'Previous Step', 'beetan' ); ?></a>
            <a href="#" class="multistep-checkout-next"
               data-target="payment"><?php echo esc_html__( 'Next Step', 'beetan' ); ?><span
                        class="material-icons">east</span></a>
        </div>
		<?php
		
		echo '</div>';
	}
}

if ( ! function_exists( 'beetan_multistep_checkout_third_step_wrap' ) ) {
	/**
	 * Multistep checkout second step start
	 */
	function beetan_multistep_checkout_third_step_wrap() {
		echo '<div class="multistep-checkout-content" data-step="payment">';
		
		do_action( 'beetan_multistep_checkout_third_step' );
		
		?>
        <div class="multistep-checkout-navigation">
            <a href="#" class="multistep-checkout-prev"><span
                        class="material-icons">west</span><?php echo esc_html__( 'Previous Step', 'beetan' ); ?></a>
        </div>
		<?php
		
		echo '</div>';
	}
}

if ( ! function_exists( 'beetan_button_place_order' ) ) {
	/**
	 * Change checkout page `Place Order` button
	 */
	function beetan_button_place_order( $button_text ) {
		if ( get_theme_mod( 'change_place_order_button_text', false ) ) {
			$button_text = get_theme_mod( 'place_order_button_text' );
		}
		
		$show_price  = get_theme_mod( 'enable_price_on_place_order_button', false );
		$total_price = '';
		
		if ( $show_price ) {
			global $woocommerce;
			
			if ( isset( $woocommerce->cart->total ) ) {
				$cart_total  = $woocommerce->cart->total;
				$total_price = ' ' . get_woocommerce_currency_symbol() . $cart_total;
			}
		}
		
		if ( ! empty( $button_text ) && ! $show_price ) {
			$button_text = esc_html( $button_text );
		}
		
		$button_text = $button_text . $total_price;
		
		return $button_text;
	}
}
add_filter( 'woocommerce_order_button_text', 'beetan_button_place_order' );

if ( ! function_exists( 'beetan_sticky_add_to_cart' ) ) {
	/**
	 * Single product sticky Add to Cart markup
	 */
	function beetan_sticky_add_to_cart() {
		if ( is_product() ) {
			global $post;
			$product = wc_get_product( $post->ID );
			
			if ( ( $product->is_purchasable() && ( $product->is_in_stock() || $product->backorders_allowed() ) ) || $product->is_type( 'external' ) ) {
				$class = 'beetan-sticky-add-to-cart';
				$class .= ' position-' . get_theme_mod( 'sticky_add_to_cart_position', 'bottom' );
				$class .= ' visibility-' . get_theme_mod( 'sticky_add_to_cart_visibility', 'desktop-only' );
				?>
                <div class="<?php echo esc_attr( $class ); ?>">
                    <div class="beetan-container">
                        <div class="beetan-sticky-add-to-cart-content">

                            <div class="beetan-sticky-add-to-cart-product-title-wrap">
                                <div class="beetan-sticky-add-to-cart-product-image">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
                                </div>

                                <div class="beetan-sticky-add-to-cart-product-title">
									<?php the_title( '<h5 class="sticky-add-to-cart-title">', '</h5>' ); ?>
                                </div>
                            </div>

                            <div class="beetan-sticky-add-to-cart-product-button-wrap">
								<?php
								if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) || $product->is_type( 'subscription' ) ) {
									echo '<span class="beetan-sticky-add-to-cart-product-price price">' . wp_kses_post( $product->get_price_html() ) . '</span>';
									woocommerce_template_single_add_to_cart();
								} else {
									echo '<span class="beetan-sticky-add-to-cart-action-price price">' . wp_kses_post( $product->get_price_html() ) . '</span>';
									echo '<a href="#product-' . esc_attr( $product->get_ID() ) . '" class="single_link_to_cart_button button alt">' . esc_html( $product->add_to_cart_text() ) . '</a>';
								}
								?>
                            </div>

                        </div>

                    </div>
                </div>
				<?php
			}
		}
	}
}
