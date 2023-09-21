<?php
function my_custom_wc_theme_support(){
    add_theme_support( 'woocommerce');
    add_theme_support('wc-product-gallery-lightbox' );
    add_theme_support('wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'my_custom_wc_theme_support');


function initTheme(){
    //Đưa trình soạn thảo của wrodpress về phiên bản cũ
    add_filter('use_block_editor_for_post', '__return_false');

    //Đăng ký menu cho website:
    register_nav_menu('header-top',__( 'Menu top' ));
    register_nav_menu('header-main',__( 'Menu chính' ));
    register_nav_menu('footer-menu',__( 'Menu footer' ));

    //Đăng ký sidebar cho website   
    if (function_exists('register_sidebar')){
        register_sidebar(array(
            'name'=> 'Cột bên',
            'id' => 'sidebar',
        ));
    }

    //Tính lượt view: 
    function setpostview($postID){
        $count_key ='views';
        $count = get_post_meta($postID, $count_key, true);
        if($count == ''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    function getpostviews($postID){
        $count_key ='views';
        $count = get_post_meta($postID, $count_key, true);
        if($count == ''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }
}
add_action( 'init', 'initTheme');

//Điều khiển slider qua wordpress
//https://huykira.net/webmaster/wordpress/custom-post-type-trong-wordpress-dung-toolset.html
function slider_post_type(){
    $label = array(
        'name' => 'Ảnh slider', //Tên post type dạng số nhiều
        'singular_name' => 'Ảnh slider' //Tên post type dạng số ít
    );
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type đăng slider', //Mô tả của post type
        'supports' => array(
            'title',
            'thumbnail'
        ),
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-format-gallery', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
 
    register_post_type('slider', $args); //Tạo post type với slug tên là slider và các tham số trong biến $args ở trên
    //cụm slider này phải nhớ để vào wordpress gọi
 
}
add_action('init', 'slider_post_type');
function wpdocs_theme_slug_widgets_init() {

    register_sidebar( array(
    
    'name'          => __( 'Tên sidebar', 'text_domain' ),
    
    'id'            => 'sidebar-1',
    
    'description'   => __( 'Mô tả sidebar', 'text_domain' ),
    
    'before_widget' => '<div class=”widget”>',
    
    'after_widget'  => '</div>',
    
    'before_title'  => '<h2 class=”widget-title”>',
    
    'after_title'   => '</h2>',
    
    ) );
    
    }
    
    add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

//---------------------------------------=============================================