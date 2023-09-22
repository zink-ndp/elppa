<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beetan
 */

get_header();

/**
 * Functions hooked in to beetan_before_main_content action
 *
 * @hooked beetan_before_main_content_wrapper   -   9
 */
do_action( 'beetan_before_main_content' );

do_action( 'beetan_before_loop' );

while ( have_posts() ) {
	the_post();

	get_template_part( 'template-parts/content/content', 'page' );

	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

do_action( 'beetan_after_loop' );

/**
 * Functions hooked in to beetan_after_main_content action
 *
 * @hooked beetan_after_main_content_wrapper    -   99
 */
do_action( 'beetan_after_main_content' );

get_footer();
