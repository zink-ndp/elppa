<section class="content-area">
	<?php
	if ( 'stretched' !== beetan_container_layout() && 'left_sidebar' == beetan_sidebar_layout() && ( ! is_page_template( array(
			'templates/template-fullwidth-container.php',
			'templates/template-fullwidth.php'
		) ) ) ) {
		get_sidebar();
	}
	?>

    <main id="primary" class="site-main">