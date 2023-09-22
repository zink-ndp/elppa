/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
jQuery(function ($) {
  $('form.cart').on('submit', function (e) {
    e.preventDefault();
    var form = $(this),
        qntInput = form.find('input.qty');
    var form_data = new FormData(form[0]);
    form_data.append('add-to-cart', form.find('[name=add-to-cart]').val());
    form_data.append('ajax_nonce', beetan_single_ajax_add_to_cart.ajax_nonce);
    form.block({
      message: null,
      overlayCSS: {
        background: '#fff',
        opacity: 0.6
      }
    });
    $.ajax({
      type: 'POST',
      url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'beetan_single_ajax_add_to_cart'),
      data: form_data,
      processData: false,
      contentType: false,
      cache: false,
      success: function success(response) {
        if (!response) {
          return;
        } // Redirect to product when error


        if (response.error && response.product_url) {
          window.location = response.product_url;
          return;
        } // Redirect to cart option.


        if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
          window.location = wc_add_to_cart_params.cart_url;
          return;
        } // Trigger event so themes can refresh other areas.


        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]); // Remove existing notices

        $('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove(); // Adding new notice

        form.closest('.single-product').find('div.product').before(response.fragments.notices_html); // Scroll to notice

        $('html').animate({
          scrollTop: $('.woocommerce-notices-wrapper').offset().top - 40
        }, 700); // Set quantity initial value
        // @TODO: Add min/max support

        qntInput.val(1);
        form.unblock();
      },
      error: function error(_error) {
        // console.log(error)
        form.unblock();
      }
    });
  });
});
/******/ })()
;