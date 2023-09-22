<?php
get_template_part( 'template-parts/header/header-brand' );

do_action( 'beetan_before_main_navigation' );

get_template_part( 'template-parts/header/header-nav' );

do_action( 'beetan_after_main_navigation' );

get_template_part( 'template-parts/header/header-right' );