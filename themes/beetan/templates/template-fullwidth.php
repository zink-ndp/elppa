<?php
/**
 * The template for displaying full width pages without container
 *
 * Template Name: Full Width Template - Stretched
 * Template Post Type: post, page
 *
 * @package beetan
 */

get_header();

/**
 * Functions hooked in to beetan_before_main_content action
 *
 * @hooked beetan_before_main_content_wrapper    -   9
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