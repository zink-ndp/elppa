<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package  Jot Shop
 * @since 1.0.0
 */ 
?>
<footer>
         <?php 
          // top-footer 
          do_action( 'jot_shop_top_footer' ); 
          // widget-footer
		      do_action( 'jot_shop_widget_footer' );
		      // below-footer
          // below-footer
          do_action( 'jot_shop_below_footer' );  
          do_action( 'jot_shop_pro_below_footer' );  
        ?>
     </footer> <!-- end footer -->
    </div> <!-- end jotshop-site -->
<?php wp_footer(); ?>
</body>
</html>