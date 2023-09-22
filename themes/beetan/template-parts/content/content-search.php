<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beetan
 */
$layout = get_theme_mod( 'blog_layout', 'default' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php beetan_post_thumbnail(); ?>

    <header class="entry-header">
		<?php
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

		if ( 'post' === get_post_type() ) {
			beetan_entry_meta();
		}
		?>

        <div class="entry-summary">
			<?php the_excerpt(); ?>
        </div><!-- .entry-summary -->

	    <?php if ( 'list' == $layout ) { ?>
		    <?php beetan_entry_footer(); ?>
	    <?php } ?>
    </header><!-- .entry-header -->

	<?php if ( 'list' !== $layout ) { ?>
        <footer class="entry-footer">
			<?php beetan_entry_footer(); ?>
        </footer><!-- .entry-footer -->
	<?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->
