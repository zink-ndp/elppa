<?php
if ( is_home() || is_archive() || is_search() ) {
	$classes = apply_filters( 'beetan_posts_wrapper_class', array( 'posts-wrapper' ) );

	if ( is_array( $classes ) ) {
		$classes = implode( ' ', $classes );
	}

	echo '<div class="' . esc_attr( $classes ) . '" ' . beetan_masonry_layout_data() . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}