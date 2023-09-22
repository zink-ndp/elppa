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
  var Customize_Range_Control = {
    toggle: function toggle(value) {
      var expected = this.params.required[1];

      if (value == expected) {
        this.container.show();
      } else {
        this.container.hide();
      }
    },
    ready: function ready() {
      var _this = this;

      if (this.params.required) {
        wp.customize(this.params.required[0], function (value) {
          _this.toggle(value.get());

          value.bind(function (changedValue) {
            _this.toggle(changedValue);
          });
        });
      }

      var slider = $('.customize-control-range'),
          range = $('.customize-control-range-slider'),
          valueWrap = $('.customize-control-range-value-wrap'),
          value = $('.customize-control-range-value');
      slider.each(function () {
        range.on('input', function () {
          $(this).next(valueWrap).find(value).val($(this).val());
        });
        value.on('input', function () {
          var min = parseInt($(this).parent(valueWrap).prev(range).attr('min'));
          var max = parseInt($(this).parent(valueWrap).prev(range).attr('max'));

          if (this.value < min) {
            this.value = min;
          } else if (this.value > max) {
            this.value = max;
          }

          $(this).parent(valueWrap).prev(range).val($(this).val()).change();
        });
      });
    }
  };
  wp.customize.controlConstructor['range'] = wp.customize.Control.extend(Customize_Range_Control);
})(jQuery);
/******/ })()
;