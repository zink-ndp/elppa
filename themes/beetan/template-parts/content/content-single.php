<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beetan
 */

do_action( 'beetan_before_single_post_article' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'beetan_single_post_article_classes', '' ) ); ?>>
	<?php
	/**
	 * Functions hooked in to beetan_before_single_post_article_content action
	 *
	 * @hooked beetan_post_thumbnail            -   10
	 * @hooked beetan_single_post_entry_header  -   20
	 */
	do_action( 'beetan_before_single_post_article_content' );
	?>

    <div class="entry-content">
		<?php
		do_action( 'beetan_before_single_post_entry_content' );

		the_content(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'beetan' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beetan' ),
				'after'  => '</div>',
			)
		);

		do_action( 'beetan_after_single_post_entry_content' );
		?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
		<?php
		/**
		 * Functions hooked in to beetan_single_post_entry_footer_content action
		 *
		 * @hooked beetan_entry_footer  -   10
		 */
		do_action( 'beetan_single_post_entry_footer_content' );
		?>
    </footer><!-- .entry-footer -->

	<?php do_action( 'beetan_after_single_post_article_content' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'beetan_after_single_post_article' ); ?>
