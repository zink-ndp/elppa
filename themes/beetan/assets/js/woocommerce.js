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
  // "use strict";
  // Cart auto update
  if (true === document.body.classList.contains('cart-auto-update')) {
    var timeout = null;
    $('.woocommerce').on('change', '.cart_item input.qty', function () {
      if (timeout !== null) {
        clearTimeout(timeout);
      }

      timeout = setTimeout(function () {
        $("[name='update_cart']").trigger("click"); // trigger cart update
      }, 1000);
    });
  } // Shop Offcanvas Sidebar Filter


  if (true === document.body.classList.contains('shop-offcanvas-sidebar')) {
    var filterBtn = document.getElementById('shop-filter-btn');
    var sidebarClose = document.querySelectorAll('.sidebar-close, .site-overlay');

    if (null !== filterBtn) {
      filterBtn.addEventListener('click', function (e) {
        e.preventDefault();
        document.body.style.overflowY = 'hidden';
        document.getElementById('secondary').classList.add('open');
        document.getElementById('site-overlay').classList.add('active');
      });
    }

    if (sidebarClose.length > 0) {
      sidebarClose.forEach(function (item) {
        item.addEventListener('click', function () {
          document.body.style.overflowY = null;
          document.getElementById('secondary').classList.remove('open');
          document.getElementById('site-overlay').classList.remove('active');
        });
      });
    }
  } // Set a Cookie


  function beetanSetCookie(Name, Value, expDays) {
    var date = new Date();
    date.setTime(date.getTime() + expDays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + date.toUTCString();
    document.cookie = Name + "=" + Value + "; " + expires + "; path=/";
  } // Get a Cookie


  function beetanGetCookie(Name) {
    var name = Name + "=";
    var cDecoded = decodeURIComponent(document.cookie); // to be careful

    var cArr = cDecoded.split('; ');
    var res;
    cArr.forEach(function (val) {
      if (val.indexOf(name) === 0) res = val.substring(name.length);
    });
    return res;
  } // Shop layout btn .active class


  $('.beetan-shop-layout').on('click', '.shop-layout-btn', function () {
    $(this).addClass('active').siblings().removeClass('active');
  }); // Add grid layout class

  var gridBtn = document.getElementById('grid-view-btn');

  if (null !== gridBtn) {
    gridBtn.onclick = function (e) {
      e.preventDefault();
      var products_wrap = document.querySelector(".archive.woocommerce ul.products");
      beetanFadeOut(products_wrap, {
        callback: function callback() {
          products_wrap.classList.add("grid");
          products_wrap.classList.remove("list");
          beetanFadeIn(products_wrap);
        }
      });
      beetanSetCookie('beetan_shop_layout', 'grid', 1);
    };
  } // Add list layout class


  var listBtn = document.getElementById('list-view-btn');

  if (null !== listBtn) {
    listBtn.onclick = function (e) {
      e.preventDefault();
      var products_wrap = document.querySelector(".archive.woocommerce ul.products");
      beetanFadeOut(products_wrap, {
        callback: function callback() {
          products_wrap.classList.add("list");
          products_wrap.classList.remove("grid");
          beetanFadeIn(products_wrap);
        }
      });
      beetanSetCookie('beetan_shop_layout', 'list', 1);
    };
  } // Shop Grid/List switch


  document.onreadystatechange = function () {
    var layout_cookie = beetanGetCookie('beetan_shop_layout');
    var products_wrap = document.querySelector('.archive.woocommerce ul.products');
    var list_btn = document.getElementById('list-view-btn');
    var grid_btn = document.getElementById('grid-view-btn');

    if (null === products_wrap) {
      return;
    }

    if (null === document.querySelector('.beetan-shop-layout')) {
      return;
    }

    if ('list' === layout_cookie) {
      list_btn.classList.add("active");
      grid_btn.classList.remove("active");
      products_wrap.classList.add("list");
    } else {
      grid_btn.classList.add("active");
      list_btn.classList.remove("active");
      products_wrap.classList.add("grid");
    }
  };

  var beetanFadeIn = function beetanFadeIn(element) {
    var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    var options = {
      duration: 300,
      display: null,
      opacity: 1,
      callback: null
    };
    Object.assign(options, _options);
    element.style.opacity = 0; // element.style.display = options.display || "block";

    setTimeout(function () {
      element.style.transition = "".concat(options.duration, "ms opacity ease");
      element.style.opacity = options.opacity;
    }, 5);
    setTimeout(function () {
      element.style.removeProperty("transition");
      !!options.callback && options.callback();
    }, options.duration + 50);
  };

  var beetanFadeOut = function beetanFadeOut(element) {
    var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    // if (element.style.display === "none") {
    //     return;
    // }
    var options = {
      duration: 300,
      display: null,
      opacity: 0,
      callback: null
    };
    Object.assign(options, _options);
    element.style.opacity = 1; // element.style.display = options.display || "block";

    setTimeout(function () {
      element.style.transition = "".concat(options.duration, "ms opacity ease");
      element.style.opacity = options.opacity;
    }, 5);
    setTimeout(function () {
      // element.style.display = "none";
      element.style.removeProperty("transition");
      !!options.callback && options.callback();
    }, options.duration + 50);
  };
})(jQuery);
/******/ })()
;