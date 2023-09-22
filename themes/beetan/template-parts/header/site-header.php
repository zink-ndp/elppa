<?php
$header_variation = get_theme_mod( 'header_variation', '3' );
$header_container = get_theme_mod( 'header_container', 'container' );
?>

<header id="masthead" class="site-header site-header__<?php echo esc_attr( $header_variation ); ?>">

	<?php
	/**
	 * Functions hooked in to beetan_before_header_content action
	 *
	 * @hooked beetan_site_header_top   -   10
	 */
    do_action( 'beetan_before_header_content' );
    ?>

	<div class="beetan-<?php echo esc_attr( $header_container ); ?>">

		<?php get_template_part( 'template-parts/header/header', $header_variation ); ?>

	</div>

	<?php do_action( 'beetan_after_header_content' ); ?>

</header><!-- #masthead -->