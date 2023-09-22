<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beetan
 */

if ( beetan_is_woocommerce_sidebar_disable() ) {
	return;
}

$beetan_sidebar = apply_filters( 'beetan_get_sidebar', 'sidebar' );
?>

<aside id="secondary" class="widget-area">
	<?php
	do_action( 'beetan_before_sidebar_widgets' );
	
	if ( is_active_sidebar( $beetan_sidebar ) ) { ?>
		
		<?php dynamic_sidebar( $beetan_sidebar ); ?>
	
	<?php } elseif ( is_user_logged_in() ) { ?>

        <section class="widget widget_text default-widget">
            <h4 class="widget-title">
				<?php esc_html_e( 'Sidebar Widget', 'beetan' ); ?>
            </h4>

            <div class="textwidget">
                <p>
					<?php
					printf(
					/* translators: 1: admin URL */
						__( 'There has not sidebar to show, add widgets by going to <a href="%1$s"><strong>Appearance / Widgets </strong></a> and dragging widgets into widget area.', 'beetan' ), esc_url( admin_url( 'widgets.php' ) ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					);  // phpcs:ignore WordPress.Security.EscapeOutput.DeprecatedWhitelistCommentFound
					?>
                </p>
            </div>
        </section>
	
	<?php }
	
	do_action( 'beetan_after_sidebar_widgets' );
	?>
</aside><!-- #secondary -->
