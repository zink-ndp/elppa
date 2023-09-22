<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="woocommerce-mini-cart-wrap">

    <div class="woocommerce-mini-cart__header">
        <h4 class="woocommerce-mini-cart__header-title"><?php echo esc_html__( 'Cart', 'beetan' ); ?></h4>
        <a href="#" id="cart-close"><span class="material-icons">close</span></a>
    </div>
	
	<?php if ( ! WC()->cart->is_empty() ) { ?>

        <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post"
              class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
			
			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce', false ); ?>
            <input type="hidden" name="_wp_http_referer" value="<?php echo esc_url( wc_get_cart_url() ); ?>">
            <input type="hidden" name="update_cart" value="Update Cart">
			
			<?php
			do_action( 'woocommerce_before_mini_cart_contents' );
			
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
                    <div class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

                        <div class="woocommerce-mini-cart-item__image">
							<?php if ( empty( $product_permalink ) ) { ?>
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php } else { ?>
                                <a href="<?php echo esc_url( $product_permalink ); ?>">
									<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </a>
							<?php } ?>
                        </div>

                        <div class="woocommerce-mini-cart-item__details">

                            <div class="woocommerce-mini-cart-item__title">
								<?php if ( empty( $product_permalink ) ) { ?>
                                    <h4 class="woocommerce-mini-cart-item__title-text"><?php echo esc_html( $product_name ); ?></h4>
								<?php } else { ?>
                                    <a href="<?php echo esc_url( $product_permalink ); ?>">
                                        <h4 class="woocommerce-mini-cart-item__title-text"><?php echo esc_html( $product_name ); ?></h4>
                                    </a>
								<?php } ?>
                            </div>
							
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<div class="woocommerce-mini-cart-item__price">' . $product_price . '</div>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
							
							<?php
							$input_args = array(
								'input_name'  => "cart[{$cart_item_key}][qty]",
								'input_value' => $cart_item['quantity'],
								'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								'min_value'   => '1'
							);
							
							$product_quantity = woocommerce_quantity_input( $input_args, $_product, false );
							
							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
                        </div>

                        <div class="woocommerce-mini-cart-item__total">
							<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'beetan' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								),
								$cart_item_key
							);
							
							$cart_item_total = floatval( $_product->get_price() ) * absint( $cart_item['quantity'] );
							
							echo wc_price( $cart_item_total ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
                        </div>

                    </div>
					<?php
				}
			}
			
			do_action( 'woocommerce_mini_cart_contents' );
			?>

        </form>

        <div class="woocommerce-mini-cart__footer">

            <p class="woocommerce-mini-cart__subtotal subtotal total">
				<?php
				/**
				 * Hook: woocommerce_widget_shopping_cart_total.
				 *
				 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
				 */
				do_action( 'woocommerce_widget_shopping_cart_total' );
				?>
            </p>
			
			<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

            <p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
			
			<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
        </div>
	
	<?php } else { ?>

        <div class="woocommerce-mini-cart__footer">
            <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'beetan' ); ?></p>
        </div>
	
	<?php } ?>

</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
