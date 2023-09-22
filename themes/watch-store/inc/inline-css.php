<?php
	
	$watch_store_custom_css = '';
	
	// site title and tagline font size option
	$watch_store_site_title_font_size = get_theme_mod('watch_store_site_title_font_size', 25);{
	$watch_store_custom_css .='.logo h1 a, .logo p a{';
	$watch_store_custom_css .='font-size: '.esc_attr($watch_store_site_title_font_size).'px;';
		$watch_store_custom_css .='}';
	}

	$watch_store_site_tagline_font_size = get_theme_mod('watch_store_site_tagline_font_size', 12);{
	$watch_store_custom_css .='.logo p{';
	$watch_store_custom_css .='font-size: '.esc_attr($watch_store_site_tagline_font_size).'px;';
		$watch_store_custom_css .='}';
	}
     