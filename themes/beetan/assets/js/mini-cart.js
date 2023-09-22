/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
(function ($) {
  $(document).ready(function ($) {
    // Return on Cart, Checkout, Order Receive page
    if ($('body').is('.woocommerce-cart, .woocommerce-checkout, .woocommerce-order-received')) {
      return false;
    } // Trigger on currency switcher


    if ($('#currency-switcher').length) {
      $(document.body).trigger('wc_fragment_refresh');
    }

    var floatingCart = $('body.mini-cart-floating'),
        floatingCartWrap = $('.site-mini-cart__floating'),
        siteOverlayWrap = $('.site-overlay'); // Show floating mini cart

    floatingCart.on('click', '.site-mini-cart a.cart-contents', function (e) {
      e.preventDefault();
      floatingCartWrap.addClass('open');
      siteOverlayWrap.addClass('active');
      $('.sidebar-offcanvas-nav').removeClass('open');
    }); // Hide floating mini cart by clicking close button

    floatingCart.on('click', '.woocommerce-mini-cart-wrap #cart-close', function (e) {
      e.preventDefault();
      floatingCartWrap.removeClass('open');
      siteOverlayWrap.removeClass('active');
    }); // Hide floating mini cart by clicking on overlay

    siteOverlayWrap.on('click', function () {
      floatingCartWrap.removeClass('open');
      $(this).removeClass('active');
    }); // Mini cart quantity update

    $('.woocommerce').on('change', '.woocommerce-mini-cart-item input.qty', function () {
      var cartForm = jQuery('form.woocommerce-mini-cart'),
          formData = cartForm.serialize();
      cartForm.parent().block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      });
      jQuery.ajax({
        type: cartForm.attr('method'),
        url: cartForm.attr('action'),
        data: formData,
        dataType: 'html',
        success: function success(response) {
          var wc_cart_fragment_url = wc_cart_fragments_params.wc_ajax_url.replace("%%endpoint%%", "get_refreshed_fragments");
          jQuery.ajax({
            type: 'post',
            url: wc_cart_fragment_url,
            success: function success(response) {
              var mini_cart_wrapper = jQuery('.widget_shopping_cart_content');
              var parent = mini_cart_wrapper.parent();
              mini_cart_wrapper.remove();
              parent.append(response.fragments['div.widget_shopping_cart_content']);
            },
            complete: function complete() {
              cartForm = jQuery('form.woocommerce-mini-cart');
            }
          });
          jQuery(document.body).trigger('wc_fragment_refresh');
        }
      });
    });
  });
})(jQuery);
/******/ })()
;