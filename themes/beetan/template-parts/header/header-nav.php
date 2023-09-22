<nav id="site-navigation" class="site-navigation" itemtype="https://schema.org/SiteNavigationElement"
     itemscope="itemscope" aria-label="<?php echo esc_attr__( 'Site Navigation', 'beetan' ); ?>">
    <button class="menu-trigger" id="menu-trigger"><span class="material-icons">menu</span></button>

	<?php
	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'menu_id'         => 'primary-menu',
			'menu_class'      => 'primary-menu',
			'container_class' => 'primary-menu-container',
		)
	);
	?>
</nav><!-- #site-navigation -->