<div class="entry-meta">
	<?php
	do_action( 'beetan_before_post_entry_meta_content' );

	beetan_post_author();
	beetan_post_date();
	beetan_post_categories();
	beetan_post_comments();

	if ( is_single() ) {
		// Show post edit link
		beetan_post_edit_link();
	}

	do_action( 'beetan_after_post_entry_meta_content' );
	?>
</div>