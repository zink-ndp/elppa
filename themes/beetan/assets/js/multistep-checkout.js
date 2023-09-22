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

  var multistepCheckout = {
    init: function init() {
      // Multistep click on step progress
      $('.multistep-checkout-progress').on('click', '.multistep-item', this.stepProgressBar); // Multistep navigation

      $('.multistep-checkout-navigation').on('click', 'a', this.navigation); // Move #order_review wrap

      $('.checkout-order-review-wrapper').insertBefore($('.multistep-checkout-content[data-step="order"] .multistep-checkout-navigation'));
      setTimeout(function () {
        // Add required attr in the woocommerce inputs to make it work with jquery validate
        $('form.checkout .required, form.woocommerce-form-login .required').each(function () {
          $(this).closest('.form-row').find('input').attr('required', true);
          $(this).closest('.form-row').find('select').attr('required', true);
        });
      }, 1000);
    },
    stepProgressBar: function stepProgressBar() {
      var step = $(this).data('step'),
          current_step = $(this).siblings('.multistep-item.active'),
          isValid = $('form.woocommerce-checkout').valid(); // Scroll and focus invalid fields

      setTimeout(function () {
        $('form.woocommerce-checkout .woocommerce-input-wrapper .error:not(label), .woocommerce-form__input-checkbox[required].error').each(function () {
          $('html').animate({
            scrollTop: $(this).offset().top - 100
          }, 500);
          $(this).focus();
          return false;
        });
      }, 100); // Return in any filed is not valid

      if (!isValid) {
        current_step.addClass('error');
        return false;
      } else {
        current_step.removeClass('error');
      }

      $(this).addClass('active').siblings().removeClass('active');
      $('.multistep-checkout-content[data-step="' + step + '"]').addClass('active').siblings().removeClass('active');
    },
    navigation: function navigation(e) {
      var scrollTarget = $('.multistep-checkout-progress').offset().top - 70;

      if ($(e.target).hasClass('multistep-checkout-next')) {
        e.preventDefault();
        $('html').animate({
          setTimeout: scrollTarget
        }, 300, function () {
          setTimeout(function () {
            $('.multistep-item.active').next('.multistep-item').trigger('click');
          }, 100);
        });
      } else if ($(e.target).hasClass('multistep-checkout-prev')) {
        e.preventDefault();
        $('html').animate({
          scrollTop: scrollTarget
        }, 500, function () {
          setTimeout(function () {
            $('.multistep-item.active').prev('.multistep-item').trigger('click');
          }, 100);
        });
      }
    }
  };
  multistepCheckout.init();
})(jQuery);
/******/ })()
;