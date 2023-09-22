<?php
/**
 * Template part for displaying footer copyright
 *
 * @package Beetan
 */

defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<div class="site-footer__copyright">
    <div class="site-footer__copyright-text">
		<?php
		$default_copyright = sprintf( /* translators: %s: StorePress. */ wp_kses_post( __( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', 'beetan' ) ), date( 'Y' ), esc_html( get_option( 'blogname' ) ) );
		
		echo wp_kses_post( wpautop( get_theme_mod( 'copyright_text', $default_copyright ) ) );
		
		echo wp_kses_post( wpautop( sprintf( /* translators: %s: StorePress. */ esc_html__( 'Theme Design by %s.', 'beetan' ), '<a href="' . esc_url( __( 'https://storepress.com/', 'beetan' ) ) . '">StorePress</a>' ) ) );
		?>
    </div>
	
	<?php
	if ( has_nav_menu( 'footer-menu' ) ) {
		get_template_part( 'template-parts/footer/footer-menu' );
	}
	?>
	
	<?php
	if ( in_array( 'footer', get_theme_mod( 'payment_icons_placement', beetan_default_option( 'payment_icons_placement' ) ) ) ) {
		beetan_payment_icons_section();
	}
	?>
</div>