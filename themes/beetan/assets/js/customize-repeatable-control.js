/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var Customize_Repeatable_Row = /*#__PURE__*/function () {
  function Customize_Repeatable_Row(rowIndex, container, label) {
    _classCallCheck(this, Customize_Repeatable_Row);

    this.rowIndex = rowIndex;
    this.container = container;
    this.label = label;
    this.header = this.container.find('.repeatable-row-header');
    this.addEventListener().updateLabel();
  }

  _createClass(Customize_Repeatable_Row, [{
    key: "setRowIndex",
    value: function setRowIndex(rowIndex) {
      this.rowIndex = rowIndex;
      this.container.attr('data-row', rowIndex);
      this.container.data('row', rowIndex);
      this.updateLabel();
      return this;
    }
  }, {
    key: "toggleMinimize",
    value: function toggleMinimize() {
      // Store the previous state.
      this.container.toggleClass('minimized');
      this.header.find('.dashicons').toggleClass('dashicons-arrow-up').toggleClass('dashicons-arrow-down');
      return this;
    }
  }, {
    key: "remove",
    value: function remove() {
      this.container.slideUp(300, function () {
        jQuery(this).detach();
      });
      this.container.trigger('row:remove', [this.rowIndex]);
      return this;
    }
  }, {
    key: "updateLabel",
    value: function updateLabel() {
      this.header.find('.repeatable-row-label').text(this.label + ' ' + (this.rowIndex + 1));
      return this;
    }
  }, {
    key: "addEventListener",
    value: function addEventListener() {
      var _this = this;

      this.header.on('click', function () {
        _this.toggleMinimize();
      });
      this.header.on('mousedown', function () {
        _this.container.trigger('row:start-dragging');
      });
      this.container.on('click', '.repeatable-row-remove', function () {
        _this.remove();
      });
      this.container.on('input change', 'input, select, textarea', function (event) {
        _this.container.trigger('row:update', [_this.rowIndex, jQuery(event.target).data('field'), event.target]);
      });
      return this;
    }
  }]);

  return Customize_Repeatable_Row;
}();

var Customize_Repeatable_Control = {
  toggle: function toggle(value) {
    var expected = this.params.required[1];

    if (value == expected) {
      this.container.show();
    } else {
      this.container.hide();
    }
  },
  ready: function ready() {
    var _this2 = this;

    if (this.params.required) {
      wp.customize(this.params.required[0], function (value) {
        _this2.toggle(value.get());

        value.bind(function (changedValue) {
          _this2.toggle(changedValue);
        });
      });
    } // let settingValue = this.params.value;


    this.settingField = this.container.find('[data-customize-setting-link]').first();
    this.repeatableFieldsContainer = this.container.find('.repeatable-fields').first(); // Set number of rows to 0

    this.currentIndex = 0; // Save the rows objects

    this.rows = []; // Default limit choice

    var limit = this.params.limit;
    this.container.on('click', 'button.repeatable-add', function (event) {
      event.preventDefault();

      if (!limit || _this2.currentIndex < limit) {
        _this2.addRow().toggleMinimize(); //this.initColorPicker();
        //this.initDropdownPages(theNewRow);

      } else {
        jQuery(_this2.selector + ' .limit').addClass('highlight');
      }
    });
    this.container.on('click', '.repeatable-row-remove', function (event) {
      _this2.currentIndex--;

      if (!limit || _this2.currentIndex < limit) {
        jQuery(_this2.selector + ' .limit').removeClass('highlight');
      }
    });
    /**
     * Function that loads the Mustache template
     */

    var control = this;
    this.repeatableTemplate = _.memoize(function () {
      var compiled,

      /*
       * Underscore's default ERB-style templates are incompatible with PHP
       * when asp_tags is enabled, so WordPress uses Mustache-inspired templating syntax.
       *
       * @see trac ticket #22344.
       */
      options = {
        evaluate: /<#([\s\S]+?)#>/g,
        interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
        escape: /\{\{([^\}]+?)\}\}(?!\})/g,
        variable: 'data'
      };
      return function (data) {
        compiled = _.template(control.container.find('.customize-control-repeatable-content').first().html(), null, options);
        return compiled(data);
      };
    });
    var settingValue = this.getValue(); // Value wise create row :D

    if (settingValue.length) {
      _.each(settingValue, function (subValue) {
        _this2.addRow(subValue); // this.initColorPicker();
        // this.initDropdownPages(theNewRow, subValue);

      });
    } // Once we have displayed the rows, we cleanup the values
    // this.setValue(settingValue);


    this.repeatableFieldsContainer.sortable({
      handle: '.repeatable-row-header',
      update: function update(e, ui) {
        return _this2.sort();
      },
      axis: "y"
    });
  },
  getValue: function getValue() {
    if (this.setting.get()) {
      try {
        return JSON.parse(decodeURI(this.setting.get()));
      } catch (e) {
        console.info('JSON PARSING ISSUE:', e);
        return [];
      }
    }

    return [];
  },
  setValue: function setValue(newValue) {
    var refresh = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
    this.setting.set(encodeURI(JSON.stringify(newValue)));

    if (refresh) {
      // Trigger the change event on the hidden field so
      // previewer refresh the website on Customizer
      this.settingField.trigger('change');
    }
  },
  addRow: function addRow(data) {
    var _this3 = this;

    var template = this.repeatableTemplate(); // The template for the new row (defined on Customize_Repeatable_Control::render_content() ).

    var settingValue = this.getValue(); // Get the current setting value.

    var newRowSetting = {}; // Saves the new setting data.

    if (template) {
      var templateData = jQuery.extend(true, {}, this.params.fields); // But if we have passed data, we'll use the data values instead

      if (data) {
        for (var i in data) {
          if (data.hasOwnProperty(i) && templateData.hasOwnProperty(i)) {
            templateData[i]['default'] = data[i];
          }
        }
      }

      templateData.index = this.currentIndex; // Append the template content

      template = template(templateData); // Create a new row object and append the element

      var newRow = new Customize_Repeatable_Row(this.currentIndex, jQuery(template).appendTo(this.repeatableFieldsContainer), this.params.row_label);
      newRow.container.on('row:remove', function (e, rowIndex) {
        _this3.deleteRow(rowIndex);
      });
      newRow.container.on('row:update', function (e, rowIndex, fieldName, element) {
        //this.updateField.call(this, e, rowIndex, fieldName, element);
        _this3.updateField(e, rowIndex, fieldName, element); //newRow.updateLabel();

      }); // Add the row to rows collection

      this.rows[this.currentIndex] = newRow;

      for (var _i in templateData) {
        if (templateData.hasOwnProperty(_i)) {
          newRowSetting[_i] = templateData[_i]['default'];
        }
      }

      settingValue[this.currentIndex] = newRowSetting;
      this.setValue(settingValue, true);
      this.currentIndex++;
      return newRow;
    }
  },
  sort: function sort() {
    var _this4 = this;

    var $rows = this.repeatableFieldsContainer.find('.repeatable-row');
    var newOrder = [];
    var currentSettings = this.getValue();
    var newRows = [];
    var newSettings = [];
    $rows.each(function (i, element) {
      newOrder.push(jQuery(element).data('row'));
    });
    jQuery.each(newOrder, function (newPosition, oldPosition) {
      newRows[newPosition] = _this4.rows[oldPosition];
      newRows[newPosition].setRowIndex(newPosition);
      newSettings[newPosition] = currentSettings[oldPosition];
    });
    this.rows = newRows;
    this.setValue(newSettings);
  },
  deleteRow: function deleteRow(index) {
    var _this5 = this;

    var currentSettings = this.getValue();

    if (currentSettings[index]) {
      // Find the row
      var row = this.rows[index];

      if (row) {
        // Remove the row settings
        currentSettings.splice(index, 1); // Remove the row from the rows collection

        this.rows.splice(index, 1); // Update the new setting values

        this.setValue(currentSettings, true);
      }
    }

    this.rows.map(function (row, k) {
      return _this5.rows[k].setRowIndex(k);
    });
  },
  updateField: function updateField(e, rowIndex, fieldId, el) {
    if (!this.rows[rowIndex]) {
      return;
    }

    if (!this.params.fields[fieldId]) {
      return;
    }

    var type = this.params.fields[fieldId].type;
    var row = this.rows[rowIndex];
    var currentSettings = this.getValue();
    var element = jQuery(el);

    if ('undefined' === typeof currentSettings[row.rowIndex][fieldId]) {
      return;
    }

    if ('checkbox' === type) {
      currentSettings[row.rowIndex][fieldId] = element.is(':checked');
    } else {
      currentSettings[row.rowIndex][fieldId] = element.val();
    }

    this.setValue(currentSettings, true);
  },
  initColorPicker: function initColorPicker() {
    'use strict';

    var control = this,
        colorPicker = control.container.find('.color-picker-hex'),
        options = {},
        fieldId = colorPicker.data('field'); // We check if the color palette parameter is defined.

    if ('undefined' !== typeof fieldId && 'undefined' !== typeof control.params.fields[fieldId] && 'undefined' !== typeof control.params.fields[fieldId].palettes && 'object' === _typeof(control.params.fields[fieldId].palettes)) {
      options.palettes = control.params.fields[fieldId].palettes;
    } // When the color picker value is changed we update the value of the field


    options.change = function (event, ui) {
      var currentPicker = jQuery(event.target),
          row = currentPicker.closest('.repeatable-row'),
          rowIndex = row.data('row'),
          currentSettings = control.getValue();
      currentSettings[rowIndex][currentPicker.data('field')] = ui.color.toString();
      control.setValue(currentSettings, true);
    }; // Init the color picker


    if (0 !== colorPicker.length) {
      colorPicker.wpColorPicker(options);
    }
  },
  initDropdownPages: function initDropdownPages(theNewRow, data) {
    'use strict';

    var control = this,
        dropdown = theNewRow.container.find('.repeatable-dropdown-pages select'),
        $select,
        selectize,
        dataField;

    if (0 === dropdown.length) {
      return;
    }

    $select = jQuery(dropdown).selectize();
    selectize = $select[0].selectize;
    dataField = dropdown.data('field');

    if (data) {
      selectize.setValue(data[dataField]);
    }

    this.container.on('change', '.repeatable-dropdown-pages select', function (event) {
      var currentDropdown = jQuery(event.target),
          row = currentDropdown.closest('.repeatable-row'),
          rowIndex = row.data('row'),
          currentSettings = control.getValue();
      currentSettings[rowIndex][currentDropdown.data('field')] = jQuery(this).val();
      control.setValue(currentSettings);
    });
  }
};
wp.customize.controlConstructor.repeatable = wp.customize.Control.extend(Customize_Repeatable_Control);
/******/ })()
;