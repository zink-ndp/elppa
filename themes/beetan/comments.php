<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beetan
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$beetan_comment_count = get_comments_number();
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
		?>
        <h2 class="comments-title">
			<?php
			if ( '1' === $beetan_comment_count ) {
				esc_html_e( '1 Comment', 'beetan' );
			} else {
				printf(
				/* translators: %s: Comment count number. */
					esc_html( _nx( '%s Comment', '%s Comments', $beetan_comment_count, 'Comments title', 'beetan' ) ),
					esc_html( number_format_i18n( $beetan_comment_count ) )
				);
			}
			?>
        </h2><!-- .comments-title -->

        <ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 72,
				)
			);
			?>
        </ol><!-- .comment-list -->

		<?php
		the_comments_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle"><span class="material-icons">west</span>' . esc_html__( 'Older Comments', 'beetan' ) . '</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Newer Comments', 'beetan' ) . '<span class="material-icons">east</span></span>',
			)
		);

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) {
			?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'beetan' ); ?></p>
			<?php
		}

	} // Check for have_comments().

	comment_form(
		array(
			'title_reply' => esc_html__( 'Leave a Comment', 'beetan' ),
		)
	);
	?>

</div><!-- #comments -->
