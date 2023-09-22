<?php
/**
 * Template part for displaying footer widgets
 *
 * @package Beetan
 */

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( is_active_sidebar( 'footer' ) ) {
	?>

	<div class="site-footer__widget">
		<?php dynamic_sidebar( 'footer' ); ?>
	</div>

	<?php
}