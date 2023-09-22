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
  $(document).on('click', '.beetan-quantity-buttons a', function (e) {
    e.preventDefault();
    var wrapper = $(this).closest('.quantity');
    input = wrapper.find('.qty'), val = "" === input.val() ? 0 : input.val(), max = input.attr('max'), min = input.attr('min'), step = input.attr('step'); // Return after initialised

    if ($(wrapper).data('qtyInit')) {
      return;
    } // Return if the quantity wrap contains the .hidden class


    if (wrapper.hasClass('hidden')) {
      return;
    }

    if ($(this).hasClass('quantity-plus')) {
      if (max && max <= val) {
        input.val(parseInt(max));
        return;
      } else {
        input.val(parseInt(val) + parseInt(step));
      }
    } else {
      if (min && min >= val) {
        input.val(parseInt(min));
        return;
      } else {
        input.val(parseInt(val) - parseInt(step));
      }
    }

    input.trigger('change');
  });
})(jQuery);
/******/ })()
;