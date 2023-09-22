<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Beetan
 */

get_header();

/**
 * Functions hooked in to beetan_before_main_content action
 *
 * @hooked beetan_before_main_content_wrapper    -   9
 */
do_action( 'beetan_before_main_content' ); ?>

    <header class="page-header text-center">
        <h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'beetan' ), '<span>' . get_search_query() . '</span>' );
			?>
        </h1>
    </header><!-- .page-header -->

<?php if ( have_posts() ) {

	do_action( 'beetan_before_loop' );

	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content/content', 'search' );
	}

	do_action( 'beetan_after_loop' );

	get_template_part( 'template-parts/posts', 'paging' );

} else {

	get_template_part( 'template-parts/content/content', 'none' );

}

/**
 * Functions hooked in to beetan_after_main_content action
 *
 * @hooked beetan_after_main_content_wrapper    -   99
 */
do_action( 'beetan_after_main_content' );

get_footer();
