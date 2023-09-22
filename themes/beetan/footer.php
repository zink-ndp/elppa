<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beetan
 */

/**
 * Functions hooked in to beetan_site_footer action
 *
 * @hooked beetan_site_footer   -   10
 * @hooked beetan_site_overlay  -   20
 * @hooked beetan_search_popup  -   30
 */
do_action( 'beetan_site_footer' );
?>

</div><!-- #page -->

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/650cf0adb1aaa13b7a783a6b/1hat8oa2l';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<?php wp_footer(); ?>

</body>
</html>