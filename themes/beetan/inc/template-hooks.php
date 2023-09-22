<?php
/**
 * Beetan hooks
 */

/**
 * Site Header
 *
 * @see  beetan_skip_links()
 * @see  beetan_site_header()
 * @see  beetan_site_header_top()
 */
add_action( 'beetan_site_header', 'beetan_skip_links', 1 );
add_action( 'beetan_site_header', 'beetan_site_header', 10 );
add_action( 'beetan_before_header_content', 'beetan_site_header_top', 10 );

/**
 * Site Footer
 *
 * @see  beetan_site_footer()
 * @see  beetan_site_overlay()
 * @see  beetan_search_popup()
 * @see  beetan_footer_widgets()
 * @see  beetan_footer_copyright()
 * @see  beetan_offcanvas()
 */
add_action( 'beetan_site_footer', 'beetan_site_footer', 10 );
add_action( 'beetan_site_footer', 'beetan_site_overlay', 20 );
add_action( 'beetan_site_footer', 'beetan_search_popup', 30 );
add_action( 'beetan_footer_content', 'beetan_footer_widgets', 10 );
add_action( 'beetan_footer_content', 'beetan_footer_copyright', 20 );
add_action( 'wp_footer', 'beetan_offcanvas', 10 );
add_action( 'wp_footer', 'beetan_back_to_top_button', 10 );

/**
 * Global
 *
 * @see  beetan_before_main_content_wrapper()
 * @see  beetan_after_main_content_wrapper()
 * @see  beetan_before_loop_wrapper()
 * @see  beetan_after_loop_wrapper()
 */
add_action( 'beetan_before_main_content', 'beetan_before_main_content_wrapper', 9 );
add_action( 'beetan_after_main_content', 'beetan_after_main_content_wrapper', 99 );
add_action( 'beetan_before_loop', 'beetan_before_loop_wrapper', 9 );
add_action( 'beetan_after_loop', 'beetan_after_loop_wrapper', 99 );

/**
 * Single post
 *
 * @see  beetan_post_thumbnail()
 * @see  beetan_single_post_entry_header()
 * @see  beetan_single_post_entry_title()
 * @see  beetan_single_post_entry_meta()
 * @see  beetan_entry_footer()
 */
add_action( 'beetan_before_single_post_article_content', 'beetan_post_thumbnail', 10 );
add_action( 'beetan_before_single_post_article_content', 'beetan_single_post_entry_header', 20 );
add_action( 'beetan_single_post_entry_header_content', 'beetan_single_post_entry_title', 10 );
add_action( 'beetan_single_post_entry_header_content', 'beetan_single_post_entry_meta', 20 );
add_action( 'beetan_single_post_entry_footer_content', 'beetan_entry_footer', 10 );

/**
 * Single page
 *
 * @see  beetan_post_thumbnail()
 */
add_action( 'beetan_before_page_article_content', 'beetan_post_thumbnail', 10 );
add_action( 'beetan_before_page_article_content', 'beetan_page_entry_header', 20 );