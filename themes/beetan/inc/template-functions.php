<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Beetan
 */

if ( ! function_exists( 'beetan_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function beetan_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}
		
		if ( is_page() && beetan_get_option( 'page_title_align_center' ) ) {
			$classes[] = 'page-title-center';
		}
		
		// Add sticky header class
		if ( beetan_get_option( 'sticky_header' ) ) {
			$classes[] = 'has-sticky-header';
		}
		
		// Add float header class
		if ( beetan_get_option( 'float_header' ) ) {
			$classes[] = 'has-float-header';
		}
		
		$container_layout = beetan_container_layout();
		$sidebar_layout   = beetan_sidebar_layout();
		
		// Add site container layout class
		$classes[] = 'beetan-' . $container_layout . '-container';
		
		// Adds a class of 'beetan-has-sidebar' when there is sidebar present.
		if ( in_array( $sidebar_layout, array( 'left_sidebar', 'right_sidebar' ) ) ) {
			if ( beetan_is_woocommerce_sidebar_disable() || is_page_template( array(
					'templates/template-fullwidth-container.php',
					'templates/template-fullwidth.php'
				) ) ) {
				return $classes;
			}
			
			$classes[] = 'beetan-has-sidebar';
			$classes[] = $sidebar_layout;
		}
		
		return $classes;
	}
}
add_filter( 'body_class', 'beetan_body_classes' );

if ( ! function_exists( 'beetan_posts_wrapper_classes' ) ) {
	/**
	 * Archive posts wrapper classes
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function beetan_posts_wrapper_classes( $classes ) {
		$layout    = get_theme_mod( 'blog_layout', 'default' );
		$classes[] = 'layout-' . esc_html( $layout );
		
		if ( get_theme_mod( 'blog_featured_image_display_style', 'cover' ) === 'cover' ) {
			$classes[] = 'no-featured-image-gap';
		}
		
		if ( in_array( $layout, array( 'grid', 'masonry' ) ) ) {
			$classes[] = 'column-' . esc_html( get_theme_mod( 'blog_grid_columns', '2' ) );
		}
		
		return $classes;
	}
}
add_filter( 'beetan_posts_wrapper_class', 'beetan_posts_wrapper_classes' );

if ( ! function_exists( 'beetan_single_post_article_classes' ) ) {
	/**
	 * Single post article classes
	 *
	 * @param $classes
	 *
	 * @return mixed|string
	 */
	function beetan_single_post_article_classes( $classes ) {
		if ( ( beetan_container_layout() === 'box' ) && ( get_theme_mod( 'blog_featured_image_display_style', 'cover' ) === 'cover' ) ) {
			$classes = 'no-featured-image-gap';
		}
		
		return $classes;
	}
}
add_filter( 'beetan_single_post_article_classes', 'beetan_single_post_article_classes' );

if ( ! function_exists( 'beetan_page_article_classes' ) ) {
	/**
	 * Single page article classes
	 *
	 * @param $classes
	 *
	 * @return mixed|string
	 */
	function beetan_page_article_classes( $classes ) {
		if ( ( beetan_container_layout() === 'box' ) && ( get_theme_mod( 'blog_featured_image_display_style', 'cover' ) === 'cover' ) ) {
			$classes = 'no-featured-image-gap';
		}
		
		return $classes;
	}
}
add_filter( 'beetan_page_article_classes', 'beetan_page_article_classes' );

if ( ! function_exists( 'beetan_pingback_header' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function beetan_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
}
add_action( 'wp_head', 'beetan_pingback_header' );

if ( ! function_exists( 'beetan_custom_excerpt_more' ) ) {
	/**
	 * Add Custom Excerpt with Read more.
	 */
	function beetan_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = esc_html__( '...', 'beetan' );
		}
		
		return $more;
	}
}
add_filter( 'excerpt_more', 'beetan_custom_excerpt_more' );

if ( ! function_exists( 'beetan_excerpt_length' ) ) {
	/**
	 * Filter the excerpt length
	 */
	function beetan_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}
		
		$length = get_theme_mod( 'blog_excerpt_length', 30 );
		
		return $length;
	}
}
add_filter( 'excerpt_length', 'beetan_excerpt_length' );

if ( ! function_exists( 'beetan_skip_links' ) ) {
	/**
	 * Display Skip links
	 */
	function beetan_skip_links() {
		printf( '<a class="skip-link screen-reader-text" href="#primary">%s</a>', esc_html__( 'Skip to content', 'beetan' ) );
	}
}

if ( ! function_exists( 'beetan_post_password_form' ) ) {
	/**
	 * Retrieve protected post password form content.
	 *
	 * @param $output
	 * @param int $post
	 *
	 * @return string HTML content for password form for password protected post.
	 */
	function beetan_post_password_form( $output, $post = 0 ) {
		$post   = get_post( $post );
		$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$output = '<p class="post-password-message">' . esc_html__( 'This content is password protected. Please enter a password to view.', 'beetan' ) . '</p><form action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post"><label class="post-password-form__label" for="' . esc_attr( $label ) . '">' . esc_html_x( 'Password', 'Post password form', 'beetan' ) . '</label><input class="post-password-form__input" name="post_password" id="' . esc_attr( $label ) . '" type="password"/><button type="submit" class="post-password-form__submit" name="' . esc_attr_x( 'Submit', 'Post password form', 'beetan' ) . '"><span class="material-icons">arrow_forward</span></button></form>';
		
		return $output;
	}
}
add_filter( 'the_password_form', 'beetan_post_password_form', 10, 2 );

if ( ! function_exists( 'beetan_check_title_hide' ) ) {
	/**
	 * Post/Page title hide/show
	 */
	function beetan_check_title_hide( $value ) {
		global $post;
		
		if ( is_page() && ( get_theme_mod( 'hide_page_title', false ) === true ) ) {
			$value = false;
		}
		
		if ( is_single() && ( get_theme_mod( 'hide_single_post_title', false ) === true ) ) {
			$value = false;
		}
		
		if ( '1' === get_post_meta( $post->ID, 'beetan_hide_title', true ) ) {
			$value = false;
		}
		
		return $value;
	}
}
add_filter( 'beetan_page_title_visibility', 'beetan_check_title_hide' );
add_filter( 'beetan_post_title_visibility', 'beetan_check_title_hide' );

if ( ! function_exists( 'beetan_container_layout' ) ) {
	/**
	 * Site Container Layout
	 */
	function beetan_container_layout() {
		$post_type = get_post_type();
		$container = 'box';
		
		if ( is_singular() ) {
			if ( in_array( $post_type, array( 'post', 'page', 'product' ) ) ) {
				$container = get_theme_mod( $post_type . '_container_layout' );
			}
		}
		
		if ( is_archive() || is_search() || is_author() || is_category() || is_home() || is_tag() ) {
			$container = get_theme_mod( 'archive_post_container_layout', 'contained' );
		}
		
		if ( ( beetan_is_woocommerce_active() && is_shop() ) || ( beetan_is_woocommerce_active() && is_product_taxonomy() ) ) {
			$container = get_theme_mod( 'archive_product_container_layout', 'contained' );
		}
		
		// Customizer container layout
		if ( empty( $container ) ) {
			$container = get_theme_mod( 'default_container_layout' );
		}
		
		// Default container layout Fallback
		if ( ! in_array( $container, array( 'box', 'contained', 'stretched' ), true ) ) {
			$container = get_theme_mod( 'default_container_layout', 'box' );
		}
		
		if ( is_page_template( 'templates/template-fullwidth-container.php' ) ) {
			$container = 'contained';
		}
		
		if ( is_page_template( 'templates/template-fullwidth.php' ) ) {
			$container = 'stretched';
		}
		
		return apply_filters( 'beetan_container_layout', $container );
	}
}

if ( ! function_exists( 'beetan_sidebar_layout' ) ) {
	/**
	 * Site Sidebar Layout
	 */
	function beetan_sidebar_layout() {
		$post_type      = get_post_type();
		$sidebar_layout = '';
		
		if ( is_singular() ) {
			if ( in_array( $post_type, array( 'post', 'page', 'product' ) ) ) {
				$sidebar_layout = get_theme_mod( $post_type . '_sidebar_position' );
			}
		} elseif ( ( beetan_is_woocommerce_active() && is_shop() ) || ( beetan_is_woocommerce_active() && is_product_taxonomy() ) ) {
			$sidebar_layout = get_theme_mod( 'archive_product_sidebar_position' );
		} else {
			$sidebar_layout = get_theme_mod( 'archive_post_sidebar_position', 'no_sidebar' );
		}
		
		return apply_filters( 'beetan_sidebar_layout', $sidebar_layout );
	}
}

if ( ! function_exists( 'beetan_get_template' ) ) {
	/*
	 * Get Template with Template Argument
	 */
	function beetan_get_template( $template_name, $template_args = array(), $include_once = false ) {
		$path = apply_filters( 'beetan_theme_file_path', get_theme_file_path( $template_name ), $template_name );
		
		do_action( 'beetan_before_get_template', $template_name, $template_args, $path );
		
		extract( $template_args );
		
		if ( $include_once ) {
			include_once $path; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		} else {
			include $path; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}
		
		do_action( 'beetan_after_get_template', $template_name, $template_args, $path );
	}
}

if ( ! function_exists( 'beetan_masonry_layout_data' ) ) {
	/**
	 * Masonry layout data
	 *
	 * @param string $itemSelector
	 *
	 * @return mixed|void
	 */
	function beetan_masonry_layout_data( $itemSelector = 'article' ) {
		if ( get_theme_mod( 'blog_layout', 'default' ) !== 'masonry' ) {
			return;
		}
		
		$data = 'data-masonry=\'{ "itemSelector": "' . $itemSelector . '", "gutter": ' . esc_html( get_theme_mod( 'blog_posts_gap', 5 ) ) . ' }\'';
		
		return apply_filters( 'beetan_masonry_layout_data', wp_kses_post( $data ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'beetan_add_mobile_menu_dropdown_icon' ) ) {
	/**
	 * Add a dropdown icon to mobile menu dropdown items
	 *
	 * @param $title
	 * @param $item
	 * @param $args
	 * @param $depth
	 *
	 * @return mixed
	 */
	function beetan_add_mobile_menu_dropdown_icon( $title, $item, $args, $depth ) {
		$dropdown_button = sprintf( '<button tabindex="0" type="button" class="dropdown-icon navbar-toggle %s"><span class="material-icons">expand_more</span></button>', esc_attr( $item->menu_order ) );
		
		if ( 'offcanvas-menu' === $args->menu_id ) {
			foreach ( $item->classes as $value ) {
				if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
					$title = $title . $dropdown_button;
				}
			}
		}
		
		return $title;
	}
}
add_filter( 'nav_menu_item_title', 'beetan_add_mobile_menu_dropdown_icon', 10, 4 );


/**
 * Check is WooCommerce Activated
 *
 * @return bool
 */
function beetan_is_woocommerce_active() {
	if ( class_exists( 'WooCommerce' ) ) {
		return true;
	}
	
	return false;
}

/**
 * WooCommerce Sidebar disable pages
 *
 * @return bool
 */
function beetan_is_woocommerce_sidebar_disable() {
	if ( beetan_is_woocommerce_active() && ( is_checkout() || is_cart() || is_account_page() ) || ( 'stretched' == beetan_container_layout() ) ) {
		return true;
	}
	
	return false;
}

if ( ! function_exists( 'beetan_site_header_top' ) ) {
	/**
	 * Display the site header top
	 */
	function beetan_site_header_top() {
		get_template_part( 'template-parts/header/header-top' );
	}
}

if ( ! function_exists( 'beetan_site_header' ) ) {
	/**
	 * Display the site header
	 */
	function beetan_site_header() {
		get_template_part( 'template-parts/header/site-header' );
	}
}

if ( ! function_exists( 'beetan_site_footer' ) ) {
	/**
	 * Display the site footer
	 */
	function beetan_site_footer() {
		get_template_part( 'template-parts/footer/site-footer' );
	}
}

if ( ! function_exists( 'beetan_footer_widgets' ) ) {
	/**
	 * Display the footer widgets
	 */
	function beetan_footer_widgets() {
		get_template_part( 'template-parts/footer/footer-widgets' );
	}
}

if ( ! function_exists( 'beetan_footer_copyright' ) ) {
	/**
	 * Display the site footer credit
	 */
	function beetan_footer_copyright() {
		get_template_part( 'template-parts/footer/footer-copyright' );
	}
}

if ( ! function_exists( 'beetan_offcanvas' ) ) {
	/**
	 * Display the mobile offcanvas menu
	 */
	function beetan_offcanvas() {
		if ( wp_is_mobile() ) {
			get_template_part( 'template-parts/footer/offcanvas' );
		}
	}
}

if ( ! function_exists( 'beetan_site_overlay' ) ) {
	/**
	 * Display the site overlay
	 */
	function beetan_site_overlay() {
		echo '<div class="site-overlay" id="site-overlay"></div>';
	}
}

if ( ! function_exists( 'beetan_search_popup' ) ) {
	/**
	 * Display the search popup
	 */
	function beetan_search_popup() {
		get_template_part( 'template-parts/footer/search-popup' );
	}
}

if ( ! function_exists( 'beetan_back_to_top_button' ) ) {
	/**
	 * Display back to top button
	 */
	function beetan_back_to_top_button() {
		get_template_part( 'template-parts/footer/back-to-top-button' );
	}
}

if ( ! function_exists( 'beetan_before_main_content_wrapper' ) ) {
	/**
	 * Before main content wrapper
	 */
	function beetan_before_main_content_wrapper() {
		get_template_part( 'template-parts/global/before-main-content' );
	}
}

if ( ! function_exists( 'beetan_after_main_content_wrapper' ) ) {
	/**
	 * After main content wrapper
	 */
	function beetan_after_main_content_wrapper() {
		get_template_part( 'template-parts/global/after-main-content' );
	}
}

if ( ! function_exists( 'beetan_before_loop_wrapper' ) ) {
	/**
	 * Before loop wrapper
	 */
	function beetan_before_loop_wrapper() {
		get_template_part( 'template-parts/global/before-loop' );
	}
}

if ( ! function_exists( 'beetan_after_loop_wrapper' ) ) {
	/**
	 * After loop wrapper
	 */
	function beetan_after_loop_wrapper() {
		get_template_part( 'template-parts/global/after-loop' );
	}
}

if ( ! function_exists( 'beetan_single_post_entry_header' ) ) {
	/**
	 * Single post entry header
	 */
	function beetan_single_post_entry_header() {
		echo '<header class="entry-header">';
		
		/**
		 * Functions hooked in to beetan_single_post_entry_header_content action
		 *
		 * @hooked beetan_single_post_entry_title   -   10
		 * @hooked beetan_single_post_entry_meta    -   20
		 */
		do_action( 'beetan_single_post_entry_header_content' );
		
		echo '</header>';
	}
}

if ( ! function_exists( 'beetan_single_post_entry_title' ) ) {
	/**
	 * Single post entry title
	 */
	function beetan_single_post_entry_title() {
		if ( apply_filters( 'beetan_post_title_visibility', true ) ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
	}
}

if ( ! function_exists( 'beetan_single_post_entry_meta' ) ) {
	/**
	 * Single post entry meta
	 */
	function beetan_single_post_entry_meta() {
		if ( 'post' === get_post_type() ) {
			beetan_entry_meta();
		}
	}
}

if ( ! function_exists( 'beetan_page_entry_header' ) ) {
	/**
	 * Single page entry title
	 */
	function beetan_page_entry_header() {
		if ( apply_filters( 'beetan_page_title_visibility', true ) ) {
			the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' );
		}
	}
}

if ( ! function_exists( 'beetan_payment_icons' ) ) {
	/**
	 * Payment icons section
	 */
	function beetan_payment_icons_section() {
		get_template_part( 'template-parts/payment-icons' );
	}
}