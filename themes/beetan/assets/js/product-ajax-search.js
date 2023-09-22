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
  $(document).ready(function () {
    var timer;
    var ajax_search_wrapper = $('.beetan-ajax-search');

    if (ajax_search_wrapper.length !== 1) {
      $('<div class="beetan-ajax-search"></div>').appendTo('.search-form');
    }

    $('.beetan-ajax-search-field').on('keyup focus', function (e) {
      var input = $(this),
          inputValue = input.val(),
          mainWrapper = $('.beetan-ajax-search');
      timer && clearTimeout(timer);
      timer = setTimeout(function () {
        $.ajax({
          type: 'POST',
          url: woocommerce_params.ajax_url,
          data: {
            action: 'beetan_product_ajax_search',
            ajax_nonce: beetan_product_ajax_search.ajax_nonce,
            search_key: inputValue,
            limit: beetan_product_ajax_search.query_args.limit,
            orderby: beetan_product_ajax_search.query_args.orderby,
            order: beetan_product_ajax_search.query_args.order
          },
          success: function success(response) {
            if (!response) {
              return;
            }

            if (response.output !== "") {
              mainWrapper.addClass('result-found');
            } else {
              mainWrapper.removeClass('result-found');
            }

            mainWrapper.html(response.output);
          },
          error: function error(_error) {// console.log(error)
          }
        });
      }, 500);
    });
  });
});
/******/ })()
;