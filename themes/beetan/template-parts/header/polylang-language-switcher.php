<?php
defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! function_exists( 'pll_the_languages' ) ) {
	return;
}
?>

<ul class="site-header-language-switcher">
	<?php
	pll_the_languages(
		array(
			'dropdown'         => 1,
			'show_flags'       => 1,
			'show_names'       => 1,
			'display_names_as' => 'name',
		)
	);
	?>
</ul>
