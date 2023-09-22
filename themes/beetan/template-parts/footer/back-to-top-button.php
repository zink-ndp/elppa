<?php
defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! beetan_get_option( 'enable_back_to_top_button' ) ) {
	return;
}

$classes   = array();
$classes[] = 'position-' . beetan_get_option( 'back_to_top_button_position' );
$classes[] = 'visibility-' . beetan_get_option( 'back_to_top_button_visibility' );
$icon      = beetan_get_option( 'back_to_top_button_icon' );
?>

<div class="beetan-back-to-top <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
    <span class="material-icons"><?php echo esc_html( $icon ); ?></span>
</div>