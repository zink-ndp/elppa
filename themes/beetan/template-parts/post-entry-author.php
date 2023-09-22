<div id="author-bio" class="author-bio-area">
	<?php if ( get_avatar( get_the_author_meta( 'ID' ) ) ) { ?>
        <div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 72 ); ?>
        </div>
	<?php } ?>

    <div class="author-details">
        <h3 class="author-name"><?php the_author_posts_link(); ?></h3>

		<?php if ( get_the_author_meta( 'description' ) ) { ?>
            <p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
		<?php } ?>
    </div>
</div><!-- #author-bio -->