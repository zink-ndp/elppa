/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*global wp, CustomizeTypographyObject*/
var Customize_Typography_Control = {
  hideWeight: function hideWeight(value) {
    if (value.trim() == '') {
      this.container.hide();
    } else {
      this.container.show();
    }
  },
  // hideSubset(value){
  //     if (value.trim() == '') {
  //         this.container.hide();
  //     }
  //     else {
  //         this.container.show();
  //     }
  // },
  changeStyle: function changeStyle(value) {
    wp.customize.control("".concat(this.params.extras.id, "[style]"), function (styleControl) {
      // control.container.hide();
      var $selector = jQuery('.customize-control-typography-input', styleControl.container);
      var fontStyles = []; // console.log(styleControl.params.extras, styleControl.setting.get());

      $selector.find('option').each(function () {
        jQuery(this).remove();
      });
      var varients = _.isUndefined(CustomizeTypographyObject.googleFonts[value.trim()]) ? {} : CustomizeTypographyObject.googleFonts[value.trim()].variants;
      fontStyles = Object.keys(varients).reduce(function (data, id) {
        data.push({
          id: id,
          text: CustomizeTypographyObject.googleFonts[value.trim()].variants[id]
        });
        return data;
      }, []);
      $selector.select2({
        data: fontStyles,
        placeholder: styleControl.params.placeholder,
        multiple: true
      }).val(styleControl.setting.get()).trigger("change");
    });
  },
  // changeSubset(value){
  //     wp.customize.control(`${this.params.extras.id}[subset]`, (subsetControl) => {
  //         // control.container.hide();
  //         let $selector   = jQuery('.customize-control-typography-input', subsetControl.container);
  //         let fontSubsets = [];
  //         // console.log(subsetControl.params.extras, subsetControl.setting.get());
  //
  //         // $selector.select2().select2("destroy");
  //
  //         $selector.find('option').each(function () {
  //             jQuery(this).remove();
  //         });
  //
  //         let subsets = _.isUndefined(CustomizeTypographyObject.googleFonts[value.trim()]) ? {} : CustomizeTypographyObject.googleFonts[value.trim()].subsets;
  //
  //         fontSubsets = Object.keys(subsets).reduce((data, id) => {
  //
  //             data.push({
  //                 id,
  //                 text : CustomizeTypographyObject.googleFonts[value.trim()].subsets[id]
  //             });
  //
  //             return data;
  //
  //         }, []);
  //
  //         $selector.select2({
  //             data: fontSubsets,
  //             placeholder: subsetControl.params.placeholder,
  //             multiple: true
  //         }).val(subsetControl.setting.get()).trigger('change');
  //
  //         // $selector.select2().on('change.select2', () => {
  //         //     this.container.find('[data-customize-setting-link]').each(() => {
  //         //         jQuery(this).trigger('change')
  //         //     });
  //         // });
  //     });
  //
  // },
  ready: function ready() {
    var _this = this;

    // Select2 Init
    var $selector = jQuery('.customize-control-typography-input', this.container);
    $selector.select2({
      placeholder: this.params.placeholder
    }); // .on('select2:unselecting', () => {
    //     this.setting.set('');
    //     this.container.find('[data-customize-setting-link]').trigger('change');
    // });
    // Font Family Changed

    if (this.id == "".concat(this.params.extras.id, "[family]")) {
      wp.customize(this.id, function (value) {
        _this.changeStyle(value.get()); // this.changeSubset(value.get());


        value.bind(function (changedValue) {
          _this.changeStyle(changedValue); // this.changeSubset(changedValue);

        });
      });
    } // Hide Style Based On Family


    if (this.id == "".concat(this.params.extras.id, "[style]")) {
      wp.customize("".concat(this.params.extras.id, "[family]"), function (value) {
        _this.hideWeight(value.get());

        value.bind(function (changedValue) {
          _this.hideWeight(changedValue);
        }); // value.trigger('change');
        // jQuery(this).val(value.get()).trigger('change');
        // console.log(this)
      });
    } // Hide Subset Based On Family
    // if (this.id == `${this.params.extras.id}[subset]`) {
    //     wp.customize(`${this.params.extras.id}[family]`, (value) => {
    //         this.hideSubset(value.get());
    //
    //         value.bind((changedValue) => {
    //             this.hideSubset(changedValue);
    //         });
    //     });
    // }

  }
};
wp.customize.controlConstructor['typography'] = wp.customize.Control.extend(Customize_Typography_Control);
/******/ })()
;