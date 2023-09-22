<div class="site-header-top">
    <div class="beetan-container">
        <div class="site-header-top-left">
			<?php
			
			if ( has_nav_menu( 'top-bar' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'top-bar',
						'menu_id'        => 'top-bar-menu',
						'menu_class'     => 'top-bar-menu',
						'container'      => '',
					)
				);
			}
			?>
        </div>

        <div class="site-header-top-right">
			<?php
			get_template_part( 'template-parts/header/polylang-language-switcher' );
			get_template_part( 'template-parts/header/currency-switcher' );
			?>
        </div>
    </div>
</div>