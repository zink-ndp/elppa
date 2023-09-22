<?php

$layout       = get_theme_mod( 'blog_layout', 'default' );
$show_content = get_theme_mod( 'blog_content', 'full' );

if ( is_single() || $layout == 'default' && $show_content == 'full' && ! is_search() ) {
	// Show post tags
	beetan_post_tags();

	// Show post edit link
	beetan_post_edit_link();
}

if ( ! is_single() ) {
	$enable_read_more = get_theme_mod( 'blog_readmore', true );

	// Show read more button
	if ( $enable_read_more && ( $layout != 'default' || $show_content != 'full' ) || is_search() ) {
		printf( '<div class="read-more-link"><a href="%s" class="read-more">%s <span class="material-icons">east</span></a></div>', esc_url( get_permalink() ), esc_html__( 'Read More', 'beetan' ) );
	}
}