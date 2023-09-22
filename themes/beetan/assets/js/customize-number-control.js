/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*global wp*/
var Customize_Number_Control = {
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

    (this.params.required || []).map(function (require) {
      if (_this.id == _this.params.extras.id) {
        wp.customize(require, function (value) {
          _this.toggle(value.get());

          value.bind(function (changedValue) {
            _this.toggle(changedValue);
          });
        });
      }
    });
    this.container.on('change', 'input[type=number]', function () {
      // this.setValue();
      var min = parseInt(this.getAttribute('min'));
      var max = parseInt(this.getAttribute('max'));
      var value = parseInt(this.value);

      if (value < min) {
        this.value = min;
      } else if (value > max) {
        this.value = max;
      }
    });
  }
  /* setValue : _.debounce(function () {
        let value = [
           this.container.find('input[type=number]').val().trim()
       ].join('');
        this.setting.set(value);
       //this.container.find('[data-customize-setting-link]').val(value).trigger('change');
   }, 300)*/

};
wp.customize.controlConstructor['number'] = wp.customize.Control.extend(Customize_Number_Control);
/******/ })()
;