<?php
/**
 * Watch Store functions and definitions
 * @package Watch Store
 */

/* Theme Setup */
if ( ! function_exists( 'watch_store_setup' ) ) :

function watch_store_setup() {

	$GLOBALS['content_width'] = apply_filters( 'watch_store_content_width', 640 );

	load_theme_textdomain( 'watch-store', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	add_image_size('watch-store-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'watch-store' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );
	
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
		)	
	);

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support('responsive-embeds');

	add_editor_style( array( 'assets/css/editor-style.css', watch_store_font_url() ) );
}
endif; // watch_store_setup
add_action( 'after_setup_theme', 'watch_store_setup' );

/*Site URL*/
define('WATCH_STORE_SUPPORT',__('https://wordpress.org/support/theme/watch-store/','watch-store'));
define('WATCH_STORE_BUY_NOW',__('https://www.logicalthemes.com/themes/watch-store-wordpress-theme/','watch-store'));
define('WATCH_STORE_LIVE_DEMO',__('https://www.logicalthemes.com/watch-store-pro/','watch-store'));
define('WATCH_STORE_PRO_DOC',__('https://logicalthemes.com/docs/watch-store/','watch-store'));
define('WATCH_STORE_CREDIT',__('https://www.logicalthemes.com/themes/free-watch-store-wordpress-theme/','watch-store'));
if ( ! function_exists( 'watch_store_credit' ) ) {
	function watch_store_credit(){
		echo "<a href=".esc_url(WATCH_STORE_CREDIT)." target='_blank'>".esc_html__('Watch Store WordPress Theme','watch-store')."</a>";
	}
}


/*radio button sanitization*/
function watch_store_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function watch_store_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function watch_store_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function watch_store_sanitize_float( $input ) {
	return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'watch_store_loop_columns');
if (!function_exists('watch_store_loop_columns')) {
	function watch_store_loop_columns() {
		$columns = get_theme_mod( 'watch_store_products_per_column', 3 );
		return $columns; // 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'watch_store_shop_per_page', 20 );
function watch_store_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'watch_store_products_per_page', 9 );
	return $cols;
}

function watch_store_sanitize_dropdown_pages( $page_id, $setting ) {
  	// Ensure $input is an absolute integer.
  	$page_id = absint( $page_id );
  	// If $page_id is an ID of a published page, return it; otherwise, return the default.
  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/* Excerpt Limit Begin */
function watch_store_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/* Theme Widgets Setup */
function watch_store_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'watch-store' ),
		'description'   => esc_html__( 'Appears on blog page sidebar', 'watch-store' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Posts and Pages Sidebar', 'watch-store' ),
		'description'   => esc_html__( 'Appears on posts and pages', 'watch-store' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 3', 'watch-store' ),
		'description'   => esc_html__( 'Appears on posts and pages', 'watch-store' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'watch-store' ),
		'description'   => esc_html__( 'Appears in footer', 'watch-store' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'watch-store' ),
		'description'   => esc_html__( 'Appears in footer', 'watch-store' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'watch-store' ),
		'description'   => esc_html__( 'Appears in footer', 'watch-store' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'watch-store' ),
		'description'   => esc_html__( 'Appears in footer', 'watch-store' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'watch_store_widgets_init' );

/* Theme Font URL */
function watch_store_font_url(){
	$font_url      = '';
	$font_family   = array(
		'ABeeZee:ital@0;1',
	    'Abril+Fatfac',
	    'Acme',
	    'Anton',
	    'Architects+Daughter',
	    'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	    'Arsenal:ital,wght@0,400;0,700;1,400;1,700',
	    'Arvo:ital,wght@0,400;0,700;1,400;1,700',
	    'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Alfa+Slab+One',
	    'Averia+Serif+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
	    'Bangers',
	    'Boogaloo',
	    'Bad+Script',
	    'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Bree+Serif',
	    'BenchNine:wght@300;400;700',
	    'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	    'Cardo:ital,wght@0,400;0,700;1,400',
	    'Courgette',
	    'Cherry+Swash:wght@400;700',
	    'Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700',
	    'Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700',
	    'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	    'Cookie',
	    'Coming+Soon',
	    'Chewy',
	    'Days+One',
	    'Dosis:wght@200;300;400;500;600;700;800',
	    'Economica:ital,wght@0,400;0,700;1,400;1,700',
	    'Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Fredoka+One',
	    'Fjalla+One',
	    'Francois+One',
	    'Frank+Ruhl+Libre:wght@300;400;500;700;900',
	    'Gloria+Hallelujah',
	    'Great+Vibes',
	    'Handlee',
	    'Hammersmith+One',
	    'Heebo:wght@100;200;300;400;500;600;700;800;900',
	    'Inconsolata:wght@200;300;400;500;600;700;800;900',
	    'Indie+Flower',
	    'IM+Fell+English+SC',
	    'Julius+Sans+One',
	    'Josefin+Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
	    'Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
	    'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Kaisei+HarunoUmi:wght@400;500;700',
	    'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Lobster',
	    'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
	    'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	    'Libre+Baskerville:ital,wght@0,400;0,700;1,400',
	    'Lobster+Two:ital,wght@0,400;0,700;1,400;1,700',
	    'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900',
	    'Monda:wght@400;700',
	    'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Marck+Script',
	    'Noto+Serif:ital,wght@0,400;0,700;1,400;1,700',
	    'Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800',
	    'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Overpass+Mono:wght@300;400;500;600;700',
	    'Oxygen:wght@300;400;700',
	    'Orbitron:wght@400;500;600;700;800;900',
	    'Patua+One',
	    'Pacifico',
	    'Padauk:wght@400;700',
	    'Playball',
	    'Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
	    'PT+Sans:ital,wght@0,400;0,700;1,400;1,700',
	    'Philosopher:ital,wght@0,400;0,700;1,400;1,700',
	    'Permanent+Marker',
	    'Poiret+One',
	    'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Quicksand:wght@300;400;500;600;700',
	    'Quattrocento+Sans:ital,wght@0,400;0,700;1,400;1,700',
	    'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
	    'Rokkitt:wght@100;200;300;400;500;600;700;800;900',
	    'Russo+One',
	    'Righteous',
	    'Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Satisfy',
	    'Slabo+13px',
	    'Slabo+27px',
	    'Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900',
	    'Shadows+Into+Light+Two',
	    'Shadows+Into+Light',
	    'Sacramento',
	    'Shrikhand',
	    'Staatliches',
	    'Tangerine:wght@400;700',
	    'Trirong:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700',
	    'Unica+One',
	    'VT323',
	    'Varela+Round',
	    'Vampiro+One',
	    'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Volkhov:ital,wght@0,400;0,700;1,400;1,700',
	    'Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	    'Yanone+Kaffeesatz:wght@200;300;400;500;600;700',
	    'ZCOOL+XiaoWei'
	);

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_family ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
	return $contents;
}	

/* Theme enqueue scripts */
function watch_store_scripts() {
	wp_enqueue_style( 'watch-store-font', watch_store_font_url(), array() );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style( 'watch-store-basic-style', get_stylesheet_uri() );
	wp_style_add_data( 'watch-store-style', 'rtl', 'replace' );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	require get_parent_theme_file_path( '/inc/inline-css.php' );
	wp_add_inline_style( 'watch-store-basic-style',$watch_store_custom_css );

	// Paragraph
    $watch_store_paragraph_color = get_theme_mod('watch_store_paragraph_color', '');
    $watch_store_paragraph_font_family = get_theme_mod('watch_store_paragraph_font_family', '');
    $watch_store_paragraph_font_size = get_theme_mod('watch_store_paragraph_font_size', '');
	// "a" tag
	$watch_store_atag_color = get_theme_mod('watch_store_atag_color', '');
    $watch_store_atag_font_family = get_theme_mod('watch_store_atag_font_family', '');
	// "li" tag
	$watch_store_li_color = get_theme_mod('watch_store_li_color', '');
    $watch_store_li_font_family = get_theme_mod('watch_store_li_font_family', '');
	// H1
	$watch_store_h1_color = get_theme_mod('watch_store_h1_color', '');
    $watch_store_h1_font_family = get_theme_mod('watch_store_h1_font_family', '');
    $watch_store_h1_font_size = get_theme_mod('watch_store_h1_font_size', '');
	// H2
	$watch_store_h2_color = get_theme_mod('watch_store_h2_color', '');
    $watch_store_h2_font_family = get_theme_mod('watch_store_h2_font_family', '');
    $watch_store_h2_font_size = get_theme_mod('watch_store_h2_font_size', '');
	// H3
	$watch_store_h3_color = get_theme_mod('watch_store_h3_color', '');
    $watch_store_h3_font_family = get_theme_mod('watch_store_h3_font_family', '');
    $watch_store_h3_font_size = get_theme_mod('watch_store_h3_font_size', '');
	// H4
	$watch_store_h4_color = get_theme_mod('watch_store_h4_color', '');
    $watch_store_h4_font_family = get_theme_mod('watch_store_h4_font_family', '');
    $watch_store_h4_font_size = get_theme_mod('watch_store_h4_font_size', '');
	// H5
	$watch_store_h5_color = get_theme_mod('watch_store_h5_color', '');
    $watch_store_h5_font_family = get_theme_mod('watch_store_h5_font_family', '');
    $watch_store_h5_font_size = get_theme_mod('watch_store_h5_font_size', '');
	// H6
	$watch_store_h6_color = get_theme_mod('watch_store_h6_color', '');
    $watch_store_h6_font_family = get_theme_mod('watch_store_h6_font_family', '');
    $watch_store_h6_font_size = get_theme_mod('watch_store_h6_font_size', '');
	//Topbar
	$watch_store_top_text_color = get_theme_mod('watch_store_top_text_color', '');
	$watch_store_top_btn_color = get_theme_mod('watch_store_top_btn_color', '');
	$watch_store_topbg_color = get_theme_mod('watch_store_topbg_color', '');
	//Slider
	$watch_store_slider_title_color = get_theme_mod('watch_store_slider_title_color', '');
	$watch_store_slider_text_color = get_theme_mod('watch_store_slider_text_color', '');
	$watch_store_slider_btn_color = get_theme_mod('watch_store_slider_btn_color', '');
	$watch_store_slider_btnhvr_color = get_theme_mod('watch_store_slider_btnhvr_color', '');
	$watch_store_slider_np_color = get_theme_mod('watch_store_slider_np_color', '');

	$watch_store_custom_css ='
		p,span{
		    color:'.esc_html($watch_store_paragraph_color).'!important;
		    font-family: '.esc_html($watch_store_paragraph_font_family).';
		    font-size: '.esc_html($watch_store_paragraph_font_size).';
		}
		a{
		    color:'.esc_html($watch_store_atag_color).'!important;
		    font-family: '.esc_html($watch_store_atag_font_family).';
		}
		li{
		    color:'.esc_html($watch_store_li_color).'!important;
		    font-family: '.esc_html($watch_store_li_font_family).';
		}
		h1{
		    color:'.esc_html($watch_store_h1_color).'!important;
		    font-family: '.esc_html($watch_store_h1_font_family).'!important;
		    font-size: '.esc_html($watch_store_h1_font_size).'!important;
		}
		h2{
		    color:'.esc_html($watch_store_h2_color).'!important;
		    font-family: '.esc_html($watch_store_h2_font_family).'!important;
		    font-size: '.esc_html($watch_store_h2_font_size).'!important;
		}
		h3{
		    color:'.esc_html($watch_store_h3_color).'!important;
		    font-family: '.esc_html($watch_store_h3_font_family).'!important;
		    font-size: '.esc_html($watch_store_h3_font_size).'!important;
		}
		h4{
		    color:'.esc_html($watch_store_h4_color).'!important;
		    font-family: '.esc_html($watch_store_h4_font_family).'!important;
		    font-size: '.esc_html($watch_store_h4_font_size).'!important;
		}
		h5{
		    color:'.esc_html($watch_store_h5_color).'!important;
		    font-family: '.esc_html($watch_store_h5_font_family).'!important;
		    font-size: '.esc_html($watch_store_h5_font_size).'!important;
		}
		h6{
		    color:'.esc_html($watch_store_h6_color).'!important;
		    font-family: '.esc_html($watch_store_h6_font_family).'!important;
		    font-size: '.esc_html($watch_store_h6_font_size).'!important;
		}
		p.topbar-text, span.sale-text{
		    color:'.esc_html($watch_store_top_text_color).'!important;
		}
		.sale-btn a{
		    color:'.esc_html($watch_store_top_btn_color).'!important;
		}
		.top-header{
		    background-color:'.esc_html($watch_store_topbg_color).'!important;
		}
		#slider .inner_carousel h1{
		    color:'.esc_html($watch_store_slider_title_color).'!important;
		}
		#slider .inner_carousel p{
		    color:'.esc_html($watch_store_slider_text_color).'!important;
		}
		#slider .read-btn a{
		    color:'.esc_html($watch_store_slider_btn_color).'!important;
			border-color:'.esc_html($watch_store_slider_btn_color).'!important;
		}
		#slider .read-btn a:hover{
		    background-color:'.esc_html($watch_store_slider_btnhvr_color).'!important;
		}
		#slider .carousel-control-next-icon i, #slider .carousel-control-prev-icon i{
		    color:'.esc_html($watch_store_slider_np_color).'!important;
		}

	';
	wp_add_inline_style( 'watch-store-basic-style',$watch_store_custom_css );

	
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery') ,'',true);
	wp_enqueue_script( 'watch-store-custom-jquery', get_template_directory_uri() . '/assets/js/custom.js', array('jquery') );
	wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/assets/js/jquery.superfish.js', array('jquery') ,'',true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'watch_store_scripts' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/get-started/get-started.php';
require get_template_directory() . '/inc/tgm.php';
require get_template_directory() . '/wptt-webfont-loader.php';