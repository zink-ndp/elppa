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
var Customize_Unit_Control = {
  toggle: function toggle(value) {
    if (value.trim() == '') {
      this.container.hide();
    } else {
      this.container.show();
    }
  },
  ready: function ready() {
    var _this = this;

    this.params.required.map(function (require) {
      if (_this.id == _this.params.extras.id) {
        wp.customize(require, function (value) {
          _this.toggle(value.get());

          value.bind(function (changedValue) {
            _this.toggle(changedValue);
          });
        });
      }
    });
    this.container.on('input change', 'input[type=number]', function (event) {
      _this.setValue();
    });
    this.container.on('change', 'select', function (event) {
      _this.setValue();
    });
  },
  setValue: _.debounce(function () {
    var value = [this.container.find('input[type=number]').val().trim(), this.container.find('select').val().trim()].join('');
    this.setting.set(value);
    this.container.find('[data-customize-setting-link]').val(value).trigger('change');
  }, 300)
};
wp.customize.controlConstructor['unit'] = wp.customize.Control.extend(Customize_Unit_Control);
/******/ })()
;