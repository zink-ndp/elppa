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
  "use strict";

  $(document).ready(function () {
    var buttonWrap = $('.beetan-shop-load-more');
    var button = buttonWrap.find('.shop-load-more-btn'); // Load More

    $('.shop-load-more-btn').on('click', function () {
      var data = {
        'action': 'beetan_shop_load_more_products',
        'query': beetan_shop_load_more_products.posts,
        'page': beetan_shop_load_more_products.current_page,
        'ajax_nonce': beetan_shop_load_more_products.ajax_nonce
      };
      $.ajax({
        type: 'POST',
        url: beetan_shop_load_more_products.ajax_url,
        data: data,
        beforeSend: function beforeSend() {
          buttonWrap.addClass('loading');
          button.text(beetan_shop_load_more_products.btn_loading_text);
        },
        success: function success(_success) {
          if (_success.data) {
            $('#primary .products').append(_success.data);
            buttonWrap.removeClass('loading');
            button.text(beetan_shop_load_more_products.btn_load_more_text);
            beetan_shop_load_more_products.current_page++;

            if (beetan_shop_load_more_products.current_page == beetan_shop_load_more_products.max_page) {
              button.off('click');
              button.remove(); // if last page, remove the button
            }
          } else {
            button.off('click');
            button.remove(); // if no data, remove the button as well
          }

          $(document).trigger('beetan_shop_loadmore_products_loaded');
        },
        error: function error(_error) {
          console.log(_error);
        }
      });
    }); // Infinite Scroll

    if (buttonWrap.data('loading_type') == 'infinite_scroll') {
      $(window).scroll(function () {
        if (button.length == 0) {
          return false;
        }

        if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
          button.trigger('click');
        }
      });
    }
  });
})(jQuery);
/******/ })()
;