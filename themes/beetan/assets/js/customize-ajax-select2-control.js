/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*global wp, CustomizeAjaxSelect2Object*/
var Customize_Ajax_Select2_Control = {
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
    var $selector = jQuery('.customize-control-ajax-select2-input', this.container);
    $selector.select2({
      allowClear: true,
      placeholder: this.params.placeholder,
      ajax: {
        url: CustomizeAjaxSelect2Object.ajaxurl,
        cache: true,
        dataType: 'json',
        minimumInputLength: 3,
        delay: 200,
        data: function data(params) {
          return {
            query: params.term,
            //params.term, // search term
            action: _this.params.action,
            nonce: CustomizeAjaxSelect2Object.nonce
          };
        },
        processResults: function processResults(result, params) {
          return {
            results: result.data
          };
        }
      }
      /*templateResult(state) {
           if (state.loading) {
              return state.text;
          }
           return state.text
      },*/

      /* templateSelection(state) {
           if (state.loading) {
               return state.text;
           }
            return state.text
       },*/

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
wp.customize.controlConstructor['ajax-select2'] = wp.customize.Control.extend(Customize_Ajax_Select2_Control);
/******/ })()
;