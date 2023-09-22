<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beetan
 */

$layout       = get_theme_mod( 'blog_layout', 'default' );
$show_content = get_theme_mod( 'blog_content', 'full' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php beetan_post_thumbnail(); ?>

    <header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) {
			beetan_entry_meta();
		}
		?>

		<?php if ( $show_content == 'summary' || $layout != 'default' ) { ?>
            <div class="entry-summary">
				<?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
		<?php } ?>

		<?php if ( 'list' == $layout ) { ?>
			<?php beetan_entry_footer(); ?>
		<?php } ?>
    </header><!-- .entry-header -->

	<?php if ( $layout == 'default' && $show_content == 'full' ) { ?>
        <div class="entry-content">
			<?php
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
			?>
        </div>
	<?php } ?>

	<?php if ( 'list' !== $layout ) { ?>
        <footer class="entry-footer">
			<?php beetan_entry_footer(); ?>
        </footer><!-- .entry-footer -->
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->
