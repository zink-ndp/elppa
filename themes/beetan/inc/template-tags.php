<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Beetan
 */

if ( ! function_exists( 'beetan_post_categories' ) ) {
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function beetan_post_categories() {
		// Hide category for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ',&nbsp;', 'beetan' ) );

			if ( $categories_list ) {
				echo '<span class="cat-links"><span class="material-icons">folder_open</span>' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
}

if ( ! function_exists( 'beetan_post_date' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function beetan_post_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			/* translators: %s: Updated date text */
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>&nbsp;<time class="updated" datetime="%3$s">' . esc_html__( '(Updated %4$s)', 'beetan' ) . '</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on"><span class="material-icons">schedule</span>' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'beetan_post_author' ) ) {
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function beetan_post_author() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( '%s ', 'post author', 'beetan' ), // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"><span class="material-icons">account_circle</span> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

if ( ! function_exists( 'beetan_post_tags' ) ) {
	/**
	 * Prints HTML with meta information for the tags.
	 */
	function beetan_post_tags() {
		// Hide tag for pages.
		if ( 'post' === get_post_type() ) {
			$tags_list = get_the_tag_list( '', ' ' );

			if ( $tags_list ) {
				echo '<span class="tags-links">' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
}

if ( ! function_exists( 'beetan_post_comments' ) ) {
	/**
	 * Prints HTML with meta information for the comments.
	 */
	function beetan_post_comments() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><span class="material-icons">comment</span>';

			comments_popup_link();

			echo ' </span>';
		}
	}
}

if ( ! function_exists( 'beetan_entry_meta' ) ) {
	/**
	 * Show entry header meta information
	 */
	function beetan_entry_meta() {
		get_template_part( 'template-parts/post-entry', 'meta' );
	}
}

if ( ! function_exists( 'beetan_entry_footer' ) ) {
	/**
	 * Show entry footer meta information
	 */
	function beetan_entry_footer() {
		get_template_part( 'template-parts/post-entry', 'footer' );
	}
}

if ( ! function_exists( 'beetan_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function beetan_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) { ?>

            <div class="post-thumbnail">
				<?php
				do_action( 'beetan_before_single_post_thumbnail' );

				the_post_thumbnail( 'beetan-blog-thumb' );

				do_action( 'beetan_after_single_post_thumbnail' );
				?>
            </div><!-- .post-thumbnail -->

		<?php } else { ?>

			<?php
			$blog_layout = get_theme_mod( 'blog_layout', 'default' );
			$thumb_size  = ( $blog_layout == 'list' && ( is_archive() || is_home() || is_search() ) ) ? 'beetan-blog-list-thumb' : 'beetan-blog-thumb';
			?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php
				do_action( 'beetan_before_post_thumbnail' );

				the_post_thumbnail(
					$thumb_size,
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);

				do_action( 'beetan_after_post_thumbnail' );
				?>
            </a>

			<?php
		}
	}
}

if ( ! function_exists( 'beetan_post_edit_link' ) ) {
	/**
	 * Post edit link
	 */
	function beetan_post_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( '<span class="material-icons">edit</span> Edit <span class="screen-reader-text">%s</span>', 'beetan' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
		do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
	}
}