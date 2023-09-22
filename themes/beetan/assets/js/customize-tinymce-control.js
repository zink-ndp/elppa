/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*global wp, tinymce, switchEditors, HippoThemePluginObject*/
var Customize_TinyMCE_Control = {
  toggle: function toggle(value) {
    var expected = this.params.required[1];

    if (value == expected) {
      this.container.show();
    } else {
      this.container.hide();
    }
  },
  initializeEditor: function initializeEditor() {
    var id = this.id,
        editor,
        control;
    control = this;

    if (!document.getElementById(id)) {
      return;
    }

    if (window.tinymce.get(id)) {
      wp.editor.remove(id);
    }

    wp.editor.initialize(id, {
      tinymce: {
        // See: /wp-includes/class-wp-editor.php#571
        //toolbar1 : 'bold,italic,bullist,numlist,link,wp_media,insert',
        toolbar1: 'bold,italic,underline,bullist,numlist,link,wp_adv',
        toolbar2: 'unlink,strikethrough,forecolor,alignleft,aligncenter,alignright,alignjustify,outdent,indent',
        toolbar3: 'formatselect,pastetext,removeformat,charmap,undo,redo',
        // external_plugins : (typeof HippoThemePluginObject === 'undefined' ? {} : {themehippo : HippoThemePluginObject.mce_plugins}),
        wpautop: true // tinymce: { setup: function( editor ) { console.log( 'Editor initialized', editor ); } }

      },
      quicktags: true,
      // quicktags: { buttons: 'strong,em,link' }
      mediaButtons: true // from wp 4.9

    });
    editor = window.tinymce.get(id);

    if (!editor) {
      throw new Error('Failed to initialize editor');
    }

    editor.on('paste', function () {
      editor.setDirty(true); // Because pasting doesn't currently set the dirty state.

      if (editor.isDirty()) {
        editor.save();
        control.setting.set(editor.getContent());
      }
    });
    editor.on('NodeChange', _.debounce(function () {
      if (editor.isDirty()) {
        editor.save();
        control.setting.set(editor.getContent());
      }
    }, 300));
    editor.on('blur hide', function () {
      if (editor.isDirty()) {
        editor.save();
        control.setting.set(editor.getContent());
      }
    });
    Array.from(document.querySelectorAll("#customize-control-".concat(id, " .button.insert-media.add_media")), function (el) {
      el.innerHTML = '<span class="wp-media-buttons-icon"></span>';
    });
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

    _.defer(function () {
      _this.initializeEditor();
    });
  }
};
wp.customize.controlConstructor['tinymce'] = wp.customize.Control.extend(Customize_TinyMCE_Control);
/******/ })()
;