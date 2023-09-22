<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beetan
 */

get_header();

/**
 * Functions hooked in to beetan_before_main_content action
 *
 * @hooked beetan_before_main_content_wrapper    -   9
 */
do_action( 'beetan_before_main_content' );

if ( have_posts() ) {

	if ( is_home() && ! is_front_page() ) {
		?>
        <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </header>
		<?php
	}

	do_action( 'beetan_before_loop' );

	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content/content', 'archive' );
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
