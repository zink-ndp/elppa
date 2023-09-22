/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*global wp, customizeSelect2*/
var Customize_Select2_Control = {
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

    // console.log(this.params);
    var $selector = jQuery('.customize-control-select2-input', this.container);
    $selector.select2({
      allowClear: true,
      placeholder: this.params.placeholder
    });
    $selector.on("select2:unselect", function () {
      $selector.trigger('change');
    });

    if (this.params.required) {
      wp.customize(this.params.required[0], function (value) {
        _this.toggle(value.get());

        value.bind(function (changedValue) {
          _this.toggle(changedValue);
        });
      });
    }
    /*this.container.on('change', 'input:radio', (event) => {
     let value = jQuery(event.target).val().trim();
     this.setting.set(value);
      // We should trigger change data-customize-setting-link,
     //this.container.find('[data-customize-setting-link]').trigger('change');
     });*/

  }
};
wp.customize.controlConstructor['select2'] = wp.customize.Control.extend(Customize_Select2_Control);
/******/ })()
;