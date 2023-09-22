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
var Customize_Toggle_Control = {
  toggle: function toggle(value) {
    if (_.isEmpty(value.trim())) {
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
  }
};
wp.customize.controlConstructor['toggle'] = wp.customize.Control.extend(Customize_Toggle_Control);
/******/ })()
;