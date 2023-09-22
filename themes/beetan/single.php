<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

do_action( 'beetan_before_loop' );

while ( have_posts() ) {
	the_post();

	get_template_part( 'template-parts/content/content', 'single' );

	get_template_part( 'template-parts/post-entry', 'author' );

	$next_post = get_next_post();
	$prev_post = get_previous_post();
	$next_post_thumb = ( $next_post && has_post_thumbnail( $next_post->ID ) ) ? get_the_post_thumbnail( $next_post->ID, array( 75, 75 ) ) : '';
	$prev_post_thumb = ( $prev_post && has_post_thumbnail( $prev_post->ID ) ) ? get_the_post_thumbnail( $prev_post->ID, array( 75, 75 ) ) : '';

	the_post_navigation(
		array(
			'prev_text' => $prev_post_thumb . '<span class="nav-text"><span class="nav-title">%title</span> <span class="nav-subtitle"><span class="material-icons">west</span>' . esc_html__( 'Previous Post', 'beetan' ) . '</span></span>',
			'next_text' => $next_post_thumb . '<span class="nav-text"><span class="nav-title">%title</span> <span class="nav-subtitle">' . esc_html__( 'Next Post', 'beetan' ) . '<span class="material-icons">east</span></span></span>',
		)
	);

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