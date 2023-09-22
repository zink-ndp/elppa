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
var Customize_Checkbox_Multiple_Control = {
  ready: function ready() {
    var _this = this;

    this.container.on('change', ':checkbox', function (event) {
      var checkbox_values = jQuery(event.target).parents('.customize-control-multiple-control-choices').find('input[type="checkbox"]:checked').map(function () {
        return this.value;
      }).get().join(',');

      _this.setting.set(checkbox_values);

      _this.container.find('[data-customize-setting-link]').val(checkbox_values).trigger('change');
    });
  }
};
wp.customize.controlConstructor['checkbox-multiple'] = wp.customize.Control.extend(Customize_Checkbox_Multiple_Control);
/******/ })()
;