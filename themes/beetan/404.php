<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Beetan
 */

get_header();
?>

	<section class="content-area">
        <main id="primary" class="site-main">

            <section class="error-404 not-found text-center">

                <header class="page-header">
                    <h1 class="page-title">
	                    <?php printf( ' <span class="error-404-text">%s</span> %s', esc_html__( '404!', 'beetan' ), esc_html__( 'Oops! That page can&rsquo;t be found.', 'beetan' ) ); ?>
                    </h1>
                </header><!-- .page-header -->

                <div class="page-content">
	                <?php printf( '<p>%s</p>', esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'beetan' ) ); ?>
					<?php get_search_form(); ?>
                </div><!-- .page-content -->

            </section><!-- .error-404 -->

        </main><!-- #main -->
    </section>

<?php
get_footer();
