<?php
$payment_icons         = get_theme_mod( 'payment_icons', beetan_default_option( 'payment_icons' ) );
$payment_icons_heading = get_theme_mod( 'payment_icons_area_heading', beetan_default_option( 'payment_icons_area_heading' ) );

if ( is_array( $payment_icons ) && count( $payment_icons ) && beetan_is_woocommerce_active() ) {
	echo '<div class="payment-icons-area">';
	
	if ( ! empty( $payment_icons_heading ) ) {
		echo '<span class="payment-icons-heading">' . esc_html( $payment_icons_heading ) . '</span>';
	}
	
	foreach ( $payment_icons as $payment_icon ) {
		echo '<div class="payment-icon">';
		
		get_template_part( 'assets/images/payment-icons/icon-' . esc_html( $payment_icon ) . '.svg' );
		
		echo '</div>';
	}
	
	echo '</div>';
}