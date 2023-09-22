<?php
/**
 * Beetan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beetan
 */

if ( ! function_exists( 'beetan_version' ) ) {
	/**
	 * Theme Version
	 *
	 * @return array|false|string
	 */
	function beetan_version() {
		return wp_get_theme()->get( 'Version' );
	}
}

if ( ! function_exists( 'beetan_assets_version' ) ) {
	/**
	 * Version as file time sting
	 *
	 * @param $file
	 *
	 * @return false|int
	 */
	function beetan_assets_version( $file ) {
		$file_path = get_theme_file_path( $file );
		
		return file_exists( $file_path ) ? filemtime( $file_path ) : false;
	}
}

if ( ! function_exists( 'beetan_setup' ) ) {
	/**
	 * Theme setup function
	 */
	function beetan_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'beetan', get_template_directory() . '/languages' );
		
		// Add theme supports.
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'post-thumbnails' );
		
		add_theme_support( 'wp-block-styles' );
		
		add_theme_support( 'custom-spacing' );
		
		add_theme_support( 'responsive-embeds' );
		
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		add_theme_support( 'align-wide' );
		
		add_theme_support( 'html5',
			array(
				'search-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		
		add_theme_support( 'custom-logo',
			array(
				'height'      => 60,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		
		add_theme_support( 'block-templates' );
		
		add_theme_support( 'editor-styles' );
		
		add_theme_support( 'woocommerce' );
		
		register_nav_menus(
			array(
				'primary'     => esc_html__( 'Primary Menu', 'beetan' ),
				'top-bar'     => esc_html__( 'Top Bar Menu', 'beetan' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'beetan' ),
			)
		);
		
		add_image_size( 'beetan-blog-thumb', 800, 600, true );
		add_image_size( 'beetan-blog-list-thumb', 300, 450, true );
		
		// Enqueue editor styles.
		add_editor_style( array(
			'assets/css/theme-editor.css',
			beetan_get_google_fonts_url( array( 'body_font', 'heading_font' ) )
		) );
	}
}
add_action( 'after_setup_theme', 'beetan_setup' );

if ( ! function_exists( 'beetan_content_width' ) ) {
	/**
	 * Content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function beetan_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'beetan_content_width', 800 ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
	}
}
add_action( 'after_setup_theme', 'beetan_content_width', 0 );

if ( ! function_exists( 'beetan_widgets_init' ) ) {
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function beetan_widgets_init() {
		do_action( 'beetan_before_register_sidebar' );
		
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'beetan' ),
				'id'            => 'sidebar',
				/* translators: widget description */
				'description'   => sprintf( __( 'Add widgets here to show in site sidebar. Make sure you have enabled Sidebar layout by going to <a href="%1$s"><strong>Appearance / Customizer / Sidebar Options.</strong></a>', 'beetan' ), esc_url( admin_url( 'customize.php?autofocus%5Bsection%5D=sidebar_settings_section' ) ) ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widgets', 'beetan' ),
				'id'            => 'footer',
				'description'   => esc_html__( 'Add widgets here to show in site footer.', 'beetan' ),
				'before_widget' => '<div id="%1$s" class="site-footer__widget--item widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="site-footer__widget--title">',
				'after_title'   => '</h2>',
			)
		);
		
		do_action( 'beetan_after_register_sidebar' );
	}
}
add_action( 'widgets_init', 'beetan_widgets_init' );

if ( ! function_exists( 'beetan_enqueue_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function beetan_enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		do_action( 'beetan_before_enqueue_script' );
		
		// Include webfont loader file.
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		
		wp_enqueue_style( 'google-fonts', wptt_get_webfont_url( beetan_get_google_fonts_url( array(
			'body_font',
			'heading_font'
		) ) ), array(), null );
		wp_enqueue_style( 'beetan-style', get_stylesheet_uri(), array(), beetan_assets_version( 'style.css' ) );
		wp_enqueue_style( 'beetan-theme-style', esc_url( get_theme_file_uri( "/assets/css/theme{$suffix}.css" ) ), array(), beetan_assets_version( "/assets/css/theme{$suffix}.css" ) );
		
		if ( is_rtl() ) {
			wp_enqueue_style( 'beetan-theme-rtl-style', esc_url( get_theme_file_uri( "/assets/css/theme-rtl{$suffix}.css" ) ), array(), beetan_assets_version( "/assets/css/theme-rtl{$suffix}.css" ) );
		}
		
		wp_enqueue_script( 'beetan-theme-scripts', esc_url( get_theme_file_uri( "/assets/js/scripts{$suffix}.js" ) ), array( 'jquery' ), beetan_assets_version( "/assets/js/scripts{$suffix}.js" ), true );
		
		if ( 'masonry' === get_theme_mod( 'blog_layout' ) ) {
			wp_enqueue_script( 'beetan-masonry', esc_url( get_theme_file_uri( "/assets/js/masonry{$suffix}.js" ) ), array(), '4.2.2' );
		}
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		do_action( 'beetan_after_enqueue_script' );
	}
}
add_action( 'wp_enqueue_scripts', 'beetan_enqueue_scripts' );

if ( ! function_exists( 'beetan_google_fonts_url' ) ) {
	/**
	 * Generate Google Fonts URL
	 *
	 * @return string
	 */
	function beetan_google_fonts_url() {
		$fonts_url       = '';
		$font_families   = array();
		$font_families[] = 'Roboto:wght@300;400;500;700';
		
		$query_args = array(
			'family'  => implode( '&family=', $font_families ),
			'display' => 'swap',
			'subset'  => 'latin,latin-ext',
		);
		
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
		
		return esc_url_raw( $fonts_url );
	}
}

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_theme_file_path( '/inc/template-functions.php' );
require get_theme_file_path( '/inc/template-hooks.php' );

/**
 * Extra Functions
 */
require get_theme_file_path( '/inc/extra-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer-functions.php' );
require get_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Meta boxes
 */
require get_theme_file_path( '/inc/class-beetan-metaboxes.php' );

/**
 * Load WooCommerce compatibility file.
 */
if ( beetan_is_woocommerce_active() ) {
	require get_theme_file_path( '/inc/woocommerce/class-beetan-woocommerce.php' );
	
	if ( beetan_get_option( 'enable_currency_switcher' ) ) {
		require get_theme_file_path( '/inc/class-beetan-currency-switcher.php' );
	}
	
	
}

/**
 * Load Elementor Helper
 */
if ( defined( 'ELEMENTOR_VERSION' ) ) {
	require get_theme_file_path( '/inc/elementor-functions.php' );
}

/**
 * Load the TGM Plugin Installation
 */
if ( is_admin() && beetan_is_woocommerce_active() ) {
	require get_theme_file_path( '/inc/required-plugins/required-plugins.php' );
}

/**
 ***************************************************************************
 * Note: Do not add any custom code here.
 *
 * Please use a child-theme so that your
 * customizations aren't lost during updates.
 *
 * @see https://developer.wordpress.org/themes/advanced-topics/child-themes/
 ***************************************************************************
 */