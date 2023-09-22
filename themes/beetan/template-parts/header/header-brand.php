<div class="site-branding">
	<?php if ( has_custom_logo() ) { ?>

		<?php the_custom_logo(); ?>

	<?php } else { ?>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title"
		   rel="home"><?php bloginfo( 'name' ); ?></a>

		<?php if ( get_bloginfo( 'description', 'display' ) ) { ?>
			<p class="site-description"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
		<?php } ?>

	<?php } ?>
</div><!-- .site-branding -->