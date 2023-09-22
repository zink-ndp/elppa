<?php
defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<?php if ( beetan_get_option( 'enable_currency_switcher' ) && function_exists( 'get_woocommerce_currency_symbol' ) ) { ?>
    <div class="site-header-currency-switcher">
		<?php
		$currencies       = beetan_currency_switcher()->get_currencies();
		$current_currency = beetan_currency_switcher()->get_currency( get_woocommerce_currency() );
		?>

        <select id="currency-switcher" onchange="window.location=this.options[this.selectedIndex].dataset.url">
			<?php foreach ( $currencies as $currency ) { ?>
                <option data-url="<?php echo esc_url( beetan_currency_switcher()->get_url( $currency ) ) ?>" <?php selected( $currency, $current_currency ) ?>
                        value="<?php echo esc_attr( strtolower( $currency ) ) ?>"><?php printf( '%s (%s)', esc_html( $currency ), get_woocommerce_currency_symbol( $currency ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
			<?php } ?>
        </select>
    </div>
<?php } ?>
