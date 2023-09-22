<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beetan
 */

do_action( 'beetan_before_page_article' );
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'beetan_page_article_classes', '' ) ); ?>>
		<?php
		/**
		 * Functions hooked in to beetan_before_page_article_content action
		 *
		 * @hooked beetan_post_thumbnail        -   10
		 * @hooked beetan_page_entry_header     -   20
		 */
		do_action( 'beetan_before_page_article_content' );
		?>

        <div class="entry-content">
			<?php
			do_action( 'beetan_before_page_entry_content' );

			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beetan' ),
					'after'  => '</div>',
				)
			);

			do_action( 'beetan_after_page_entry_content' );
			?>
        </div><!-- .entry-content -->

		<?php if ( current_user_can( 'edit_post', get_the_ID() ) ) { ?>
            <footer class="entry-footer">
				<?php beetan_post_edit_link(); ?>
            </footer><!-- .entry-footer -->
		<?php } ?>

		<?php do_action( 'beetan_after_page_article_content' ); ?>
    </article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'beetan_after_page_article' ); ?>