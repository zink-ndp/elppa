<li class="site-login-menu">
    <a href="<?php echo ( beetan_is_woocommerce_active() ) ? esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) : '#'; ?>"
       class="site-navigation-right__item">
        <span class="material-icons">person</span>
    </a>

    <ul class="site-login-menu__dropdown">
        <li>
			<?php
			if ( ! is_user_logged_in() ) {
				if ( function_exists( 'woocommerce_login_form' ) && function_exists( 'woocommerce_output_all_notices' ) ) {
					ob_start();

					woocommerce_output_all_notices();
					woocommerce_login_form();

					echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			?>
        </li>
    </ul>
</li>