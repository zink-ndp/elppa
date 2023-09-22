<?php
/**
 * The template for displaying archive pages
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

get_template_part( 'template-parts/archive', 'header' );

if ( have_posts() ) {

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

