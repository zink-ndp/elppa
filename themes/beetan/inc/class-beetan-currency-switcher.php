<?php
// If plugin - 'WooCommerce' not exist then return.
if ( ! beetan_is_woocommerce_active() ) {
	return;
}

/**
 * Beetan WooCommerce Compatibility
 */
if ( ! class_exists( 'Beetan_Currency_Switcher' ) ) {
	class Beetan_Currency_Switcher {
		private static $instance;
		public         $session = 'beetan_current_currency';
		
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
		protected function __construct() {
			$this->hooks();
			
			do_action( 'beetan_currency_switcher_loaded', $this );
		}
		
		/**
		 * Hooks
		 */
		protected function hooks() {
			add_action( 'template_redirect', array( $this, 'set_currency' ), 9 );
			add_action( 'template_redirect', array( $this, 'reset_currency' ), 9 );
			
			add_filter( 'woocommerce_currency', array( $this, 'woocommerce_currency' ), 9 );
			add_filter( 'wc_price_args', array( $this, 'wc_price_args' ), 9 );
			add_filter( 'raw_woocommerce_price', array( $this, 'raw_woocommerce_price' ), 9, 2 );
			
			// Variation Swatches Shop Support
			add_filter( 'woo_variation_swatches_rest_add_extra_params', array(
				$this,
				'add_wvs_support_extra_params'
			) );
		}
		
		/**
		 *
		 * @param $currency
		 *
		 * @return string
		 */
		public function get_url( $currency ) {
			global $wp;
			
			$url         = remove_query_arg( 'beetan-switch-currency', esc_url( home_url( add_query_arg( array(), $wp->request ) ) ) );
			$current_url = add_query_arg( 'beetan-switch-currency', strtolower( $currency ), esc_url( $url ) );
			
			return apply_filters( 'beetan_currency_switcher_url', $current_url );
		}
		
		/**
		 * Set Currency
		 */
		public function set_currency() {
			if ( isset( $_GET['beetan-switch-currency'] ) && ! empty( $_GET['beetan-switch-currency'] ) ) {
				$currency = strtoupper( sanitize_text_field( $_GET['beetan-switch-currency'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
				
				setcookie( 'beetan_currency', $currency, time() + HOUR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true );
			}
		}
		
		/**
		 * Get Currency
		 *
		 * @param $currency
		 *
		 * @return mixed|string
		 */
		public function get_currency( $currency ) {
			if ( isset( $_COOKIE['beetan_currency'] ) ) {
				return sanitize_text_field( $_COOKIE['beetan_currency'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			}
			
			return $currency;
		}
		
		/**
		 * Reset Currency
		 */
		public function reset_currency() {
			// order review update
			if ( isset( $_REQUEST['action'] ) ) {
				if ( $_REQUEST['action'] == 'woocommerce_update_order_review' ) {
					setcookie( 'beetan_currency', '', time() - 3600 );
				}
			}
			
			// Ajax
			if ( isset( $_GET['wc-ajax'] ) && $_GET['wc-ajax'] == 'update_order_review' ) {
				setcookie( 'beetan_currency', '', time() - 3600 );
			}
			
			// API and PayPal Actions
			if ( isset( $_GET['wc-api'] ) && isset( $_GET['pp_action'] ) && isset( $_GET['use_paypal_credit'] ) ) {
				if ( $_GET['pp_action'] == 'expresscheckout' ) {
					setcookie( 'beetan_currency', '', time() - 3600 );
				}
			}
			
			// return true to reset session
			if ( apply_filters( 'beetan_currency_switcher_reset_condition', false ) ) {
				setcookie( 'beetan_currency', '', time() - 3600 );
			}
			
			do_action( 'beetan_currency_switcher_condition', $this );
		}
		
		/**
		 * Get Currency
		 *
		 * @return array
		 */
		public function get_currencies() {
			return (array) beetan_get_repeatable_option( 'woo_currency_switcher', 'currency' );
		}
		
		private function get_selected_index() {
			$currencies = array_flip( beetan_get_repeatable_option( 'woo_currency_switcher', 'currency' ) );
			$currency   = get_woocommerce_currency();
			
			if ( ! isset( $currencies[ $this->get_currency( $currency ) ] ) ) {
				return null;
			}
			
			return $currencies[ $this->get_currency( $currency ) ];
		}
		
		/**
		 * Modify woocommerce default saved current currency
		 *
		 * @param $currency
		 *
		 * @return mixed|string
		 */
		public function woocommerce_currency( $currency ) {
			return $this->get_currency( $currency );
		}
		
		/**
		 * Price Format
		 *
		 * @return string
		 */
		public function get_price_format() {
			$options                 = beetan_get_repeatable_option( 'woo_currency_switcher', 'currency_position' );
			$selected_currency_index = $this->get_selected_index();
			
			if ( is_null( $selected_currency_index ) ) {
				$options[ $selected_currency_index ] = get_option( 'woocommerce_currency_pos' );
			}
			
			$format = '%1$s%2$s';
			
			switch ( $options[ $selected_currency_index ] ) {
				case 'left' :
					$format = '%1$s%2$s';
					break;
				case 'right' :
					$format = '%2$s%1$s';
					break;
				case 'left_space' :
					$format = '%1$s&nbsp;%2$s';
					break;
				case 'right_space' :
					$format = '%2$s&nbsp;%1$s';
					break;
			}
			
			return $format;
		}
		
		/**
		 * Price decimal number
		 *
		 * @return false|mixed|void
		 */
		public function get_decimal_number() {
			$options                 = beetan_get_repeatable_option( 'woo_currency_switcher', 'decimal_number' );
			$selected_currency_index = $this->get_selected_index();
			
			if ( is_null( $selected_currency_index ) ) {
				$options[ $selected_currency_index ] = get_option( 'woocommerce_price_num_decimals' );
			}
			
			return $options[ $selected_currency_index ];
		}
		
		/**
		 * Price decimal separator
		 *
		 * @return false|mixed|void
		 */
		public function get_decimal_separator() {
			$options                 = beetan_get_repeatable_option( 'woo_currency_switcher', 'decimal_separator' );
			$selected_currency_index = $this->get_selected_index();
			
			if ( is_null( $selected_currency_index ) ) {
				$options[ $selected_currency_index ] = get_option( 'woocommerce_price_decimal_sep' );
			}
			
			return $options[ $selected_currency_index ];
		}
		
		/**
		 * Price thousand separator
		 *
		 * @return false|mixed|void
		 */
		public function get_thousand_separator() {
			$options                 = beetan_get_repeatable_option( 'woo_currency_switcher', 'thousand_separator' );
			$selected_currency_index = $this->get_selected_index();
			
			if ( is_null( $selected_currency_index ) ) {
				$options[ $selected_currency_index ] = get_option( 'woocommerce_price_thousand_sep' );
			}
			
			return $options[ $selected_currency_index ];
		}
		
		/**
		 * Set price args
		 *
		 * @param $args
		 *
		 * @return mixed
		 */
		public function wc_price_args( $args ) {
			$args['ex_tax_label']       = false;
			$args['currency']           = $this->get_currency( get_woocommerce_currency() );
			$args['decimal_separator']  = $this->get_decimal_separator();
			$args['thousand_separator'] = $this->get_thousand_separator();
			$args['decimals']           = $this->get_decimal_number();
			$args['price_format']       = $this->get_price_format();
			
			return $args;
		}
		
		/**
		 * Currency with fixed exchange rate
		 *
		 * @param $requested_currency
		 *
		 * @return []|array|mixed
		 */
		public function get_currency_fixed_rate( $requested_currency ) {
			$currencies         = beetan_get_repeatable_option( 'woo_currency_switcher' );
			$currency_with_rate = [];
			
			if ( ! empty( $currencies ) ) {
				foreach ( $currencies as $currency ) {
					$currency_with_rate = array_merge( $currency_with_rate, [ $currency['currency'] => $currency['currency_rate'] ] );
				}
			}
			
			return isset( $currency_with_rate[ $requested_currency ] ) ? $currency_with_rate[ $requested_currency ] : $currency_with_rate;
		}
		
		/**
		 * Calculated price
		 *
		 * @param $price
		 * @param $original_price
		 *
		 * @return float|int
		 */
		public function raw_woocommerce_price( $price, $original_price ) {
			$exchange_rate = floatval( $this->get_currency_fixed_rate( $this->get_currency( get_woocommerce_currency() ) ) );
			$price         = $original_price * $exchange_rate;
			
			return $price;
		}
		
		/**
		 * Add Variation Swatches Extra Params
		 *
		 * @param $args
		 *
		 * @return mixed
		 */
		public function add_wvs_support_extra_params( $args ) {
			$args['currency'] = get_woocommerce_currency();
			
			return $args;
		}
		
	}
}

function beetan_currency_switcher() {
	return Beetan_Currency_Switcher::instance();
}

beetan_currency_switcher();


