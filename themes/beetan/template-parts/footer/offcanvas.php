<div class="sidebar-offcanvas-nav" id="sidebar-offcanvas-nav">
    <div class="offcanvas-nav-header">
		<?php get_template_part( 'template-parts/header/header-brand' ); ?>

        <div class="offcanvas-nav-search">
			<?php get_search_form() ?>
        </div>
    </div>

    <nav id="offcanvas-navigation" class="offcanvas-navigation" itemtype="https://schema.org/SiteNavigationElement"
         itemscope="itemscope" aria-label="Site Navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'offcanvas-menu',
				'menu_class'     => 'offcanvas-menu',
				'container'      => '',
			)
		);
		?>
    </nav>

    <div class="offcanvas-nav-footer">
	    <?php
	    get_template_part( 'template-parts/header/polylang-language-switcher' );
	    get_template_part( 'template-parts/header/currency-switcher' );
        ?>
        
        <ul class="offcanvas-nav-footer-icon-nav">
	        <?php
	        if ( class_exists( 'Beetan_Woocommerce' ) ) {
		        if ( beetan_get_option( 'enable_header_mini_cart' ) && beetan_get_option( 'enable_mini_cart' ) ) {
			        echo Beetan_Woocommerce::instance()->woocommerce_mini_cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		        }
		
		        if ( beetan_get_option( 'enable_header_my_account' ) ) {
			        get_template_part( 'template-parts/header/header', 'login' );
		        }
	        }
            ?>
        </ul>
    </div>

    <button class="menu-close" id="menu-close"><span class="material-icons">close</span></button>
</div>