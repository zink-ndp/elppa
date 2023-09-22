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
  // Triggers sticky add to cart on scroll.
  var stickyAddToCartWrap = $('.beetan-sticky-add-to-cart');

  if (stickyAddToCartWrap) {
    var scrollOffset = parseInt($('.product .single_add_to_cart_button').offset().top);
    $(window).on('scroll', function () {
      if (window.scrollY >= scrollOffset) {
        stickyAddToCartWrap.addClass('is-active');
      } else {
        stickyAddToCartWrap.removeClass('is-active');
      }
    });
  } // Smooth scrolls if select option button is active.


  var smoothScrollBtn = $('.beetan-sticky-add-to-cart-product-button-wrap .single_link_to_cart_button');

  if (smoothScrollBtn) {
    $(smoothScrollBtn).on('click', function (e) {
      e.preventDefault();
      $($(this).attr('href'))[0].scrollIntoView({
        behavior: 'smooth'
      });
    });
  }
})(jQuery);
/******/ })()
;