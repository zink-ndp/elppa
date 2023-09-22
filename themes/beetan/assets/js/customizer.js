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
  // Toggle Control Based on Condition
  var toggleControl = function toggleControl(currentValue, expectedValue, controlKey) {
    // Default Hide.
    wp.customize.control(controlKey, function (control) {
      control.container.hide();
    }); // Conditional Show.

    if (_.isArray(expectedValue) && expectedValue.includes(currentValue)) {
      wp.customize.control(controlKey, function (control) {
        control.container.show();
      });
    } // Conditional Show.


    if ((_.isString(expectedValue) || _.isBoolean(expectedValue)) && expectedValue == currentValue) {
      wp.customize.control(controlKey, function (control) {
        control.container.show();
      });
    }
  };
})(jQuery);
/******/ })()
;