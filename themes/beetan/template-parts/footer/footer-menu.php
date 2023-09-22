<?php
/**
 * Template part for displaying footer menu
 *
 * @package Beetan
 */
defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<div class="site-footer__menu">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'footer-menu',
			'menu_id'        => 'footer-menu',
			'menu_class'     => 'footer-menu',
			'container'      => '',
			'depth'          => 1,
		)
	);
	?>
</div>
