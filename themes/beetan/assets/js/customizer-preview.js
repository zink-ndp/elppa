/*!
 * Beetan Theme
 *
 * Author: StorePress ( StorePressHQ@gmail.com )
 * Date: 5/11/2023, 2:42:41 PM
 * Released under the GPLv3 license.
 */
/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/* global wp, jQuery */

/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
  // Site title and description.
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  }); // Site Description

  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  }); // Set site background color

  wp.customize('site_background_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-site-background-color', to);
    });
  }); // Set site container width

  wp.customize('site_container_width', function (value) {
    value.bind(function (to) {
      if (to > 1920) {
        to = 1920;
      } else if (to < 768) {
        to = 768;
      }

      document.documentElement.style.setProperty('--beetan-site-container-width', to + 'px');
    });
  }); // Set sidebar width

  wp.customize('sidebar_width', function (value) {
    value.bind(function (to) {
      if (to > 50) {
        to = 50;
      } else if (to < 10) {
        to = 10;
      }

      document.documentElement.style.setProperty('--beetan-sidebar-width', to + '%');
    });
  }); // Set site header background color

  wp.customize('site_header_top_background_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-site-header-top-background-color', to);
    });
  }); // Set site header background color

  wp.customize('site_header_background_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-site-header-background-color', to);
    });
  }); // Set site header box shadow color

  wp.customize('site_header_box_shadow', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-site-header-box-shadow-color', to);
    });
  }); // Theme color

  wp.customize('primary_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-primary-color', to);
    });
  }); // Body font color

  wp.customize('text_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-text-color', to);
    });
  }); // Heading font color

  wp.customize('heading_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-heading-color', to);
    });
  }); // Sub Heading font color

  wp.customize('sub_heading_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-sub-heading-color', to);
    });
  }); // Link color

  wp.customize('link_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-link-color', to);
    });
  }); // Link hover color

  wp.customize('link_hover_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-link-hover-color', to);
    });
  }); // Set space between shop products

  wp.customize('shop_products_gap', function (value) {
    value.bind(function (to) {
      if (to > 100) {
        to = 100;
      } else if (to < 0) {
        to = 0;
      }

      document.documentElement.style.setProperty('--beetan-shop-products-gap', to + 'px');
    });
  }); // Set space between blog posts

  wp.customize('blog_posts_gap', function (value) {
    value.bind(function (to) {
      if (to > 100) {
        to = 100;
      } else if (to < 0) {
        to = 0;
      }

      document.documentElement.style.setProperty('--beetan-blog-posts-gap', to + 'px');
    });
  }); // Set gap inner blog posts

  wp.customize('blog_post_inner_gap', function (value) {
    value.bind(function (to) {
      if (to > 100) {
        to = 100;
      } else if (to < 0) {
        to = 0;
      }

      document.documentElement.style.setProperty('--beetan-blog-post-inner-gap', to + 'px');
    });
  }); // Blog post background color

  wp.customize('blog_post_background_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-blog-background-color', to);
    });
  }); // Set gap inner box layout

  wp.customize('box_layout_inner_gap', function (value) {
    value.bind(function (to) {
      if (to > 100) {
        to = 100;
      } else if (to < 0) {
        to = 0;
      }

      document.documentElement.style.setProperty('--beetan-box-layout-inner-gap', to + 'px');
    });
  }); // Box layout background color

  wp.customize('box_layout_background_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-box-layout-background-color', to);
    });
  }); // Set base font scale
  // wp.customize('base_font_scale', function (value) {
  //     value.bind(function (to) {
  //         document.documentElement.style.setProperty('--beetan-base-font-scale', to );
  //     });
  // });
  // Set body font size

  wp.customize('base_font_size', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-base-font-size', to + 'px');
    });
  }); // Set body font weight

  wp.customize('base_font_weight', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-base-font-weight', to);
    });
  }); // Set body line height

  wp.customize('base_line_height', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-base-line-height', to);
    });
  }); // Set paragraph margin top

  wp.customize('paragraph_margin_top', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-paragraph-margin-top', to + 'px');
    });
  }); // Set paragraph margin bottom

  wp.customize('paragraph_margin_bottom', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-paragraph-margin-bottom', to + 'px');
    });
  });

  var _loop = function _loop(i) {
    // Set heading font size
    wp.customize('h' + i + '_font_size', function (value) {
      value.bind(function (to) {
        document.documentElement.style.setProperty('--beetan-h' + i + '-font-size', to + 'px');
      });
    }); // Set heading font weight

    wp.customize('h' + i + '_font_weight', function (value) {
      value.bind(function (to) {
        document.documentElement.style.setProperty('--beetan-h' + i + '-font-weight', to);
      });
    }); // Set heading line height

    wp.customize('h' + i + '_line_height', function (value) {
      value.bind(function (to) {
        document.documentElement.style.setProperty('--beetan-h' + i + '-line-height', to);
      });
    }); // Set heading margin top

    wp.customize('h' + i + '_margin_top', function (value) {
      value.bind(function (to) {
        document.documentElement.style.setProperty('--beetan-h' + i + '-margin-top', to + 'px');
      });
    }); // Set heading margin bottom

    wp.customize('h' + i + '_margin_bottom', function (value) {
      value.bind(function (to) {
        document.documentElement.style.setProperty('--beetan-h' + i + '-margin-bottom', to + 'px');
      });
    }); // Cart page Proceed to Checkout button text change

    wp.customize('proceed_to_checkout_button_text', function (value) {
      value.bind(function (to) {
        $('.checkout-button').text(to);
      });
    }); // Checkout page Place Order button text change
    // wp.customize('place_order_button_text', function (value) {
    //     value.bind(function (to) {
    //         $('button#place_order').text(to);
    //     });
    // });
  };

  for (var i = 1; i < 7; i++) {
    _loop(i);
  } // Back to top button background color


  wp.customize('back_to_top_button_background_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-background-color', to);
    });
  }); // Back to top button icon color

  wp.customize('back_to_top_button_icon_color', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-icon-color', to);
    });
  }); // Back to top button icon size

  wp.customize('back_to_top_button_icon_size', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-icon-size', to + 'px');
    });
  }); // Back to top button width

  wp.customize('back_to_top_button_width', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-width', to + 'px');
    });
  }); // Back to top button height

  wp.customize('back_to_top_button_height', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-height', to + 'px');
    });
  }); // Back to top button border radius

  wp.customize('back_to_top_button_radius', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-radius', to + 'px');
    });
  }); // Back to top button bottom gap

  wp.customize('back_to_top_button_bottom_offset', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-bottom-offset', to + 'px');
    });
  }); // Back to top button left right gap

  wp.customize('back_to_top_button_left_right_offset', function (value) {
    value.bind(function (to) {
      document.documentElement.style.setProperty('--beetan-back-to-top-button-left-right-offset', to + 'px');
    });
  });
})(jQuery);
/******/ })()
;