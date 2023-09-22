<div class="site-navigation-right">
    <ul>
		<?php
		if ( defined( 'YITH_WCWL' ) && beetan_is_woocommerce_active() ) {
			get_template_part( 'template-parts/header/header', 'wishlist' );
		}
		
		if ( class_exists( 'Beetan_Woocommerce' ) ) {
			if ( beetan_get_option( 'enable_header_mini_cart' ) && beetan_get_option( 'enable_mini_cart' ) ) {
				echo Beetan_Woocommerce::instance()->woocommerce_mini_cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			
			if ( beetan_get_option( 'enable_header_my_account' ) ) {
				get_template_part( 'template-parts/header/header', 'login' );
			}
		}
		
		if ( beetan_get_option( 'enable_header_search' ) ) {
			get_template_part( 'template-parts/header/header', 'search' );
		}
		?>
    </ul>
</div>