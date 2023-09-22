<footer id="colophon" class="site-footer">

	<?php do_action( 'beetan_before_footer_content' ); ?>

	<div class="beetan-container">

		<?php
		/**
		 * Functions hooked in to beetan_footer_content action
		 *
		 * @hooked beetan_footer_widgets    -   10
		 * @hooked beetan_footer_copyright  -   20
		 */
		do_action( 'beetan_footer_content' );
		?>

	</div>

	<?php do_action( 'beetan_after_footer_content' ); ?>

</footer><!-- #colophon -->