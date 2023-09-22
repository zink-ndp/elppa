/**************/
// JotShopLib
/**************/
(function ($) {
    var JotShopLib = {
        init: function (){
            this.bindEvents();
        },
        bindEvents: function (){
              
             var $this = this;
             $this.sticky_header();
             $this.sticky_sidebar_hide_toggle();
             $this.sticky_product_search();
             $this.pre_loader();
             $this.sideabr_toggle();
             $this.CatMenu();
             $this.DefaultMenu();
             $this.MainMenu();
             $this.StickMenu();
             $this.AboveMenu();
             $this.MobileMenuFunction();
             $this.mobile_menu_with_woocat();
             $this.Top2Slider();
             $this.TopMultiSlide();
             $this.TopFullSlide();
                if(jot_shop.jot_shop_move_to_top_optn){
                  $this.MoveToTop();
                }
             if($('.header__cat__item.dropdown').length!==0){
             $this.cat_toggle();
             }

            

             $this.MobilenavBar();
        },
        sticky_sidebar_hide_toggle: function () {
               if($('#sidebar-primary.bigstr-sticky-sidebar').length!==0){
                      var lastScrollTop = 0;
                      $(window).on('scroll', function() {
                          st = $(this).scrollTop();
                          if(st < lastScrollTop) {

                             $('.product-cat-list').hide();
                             
                          }
                          lastScrollTop = st;
                      });
            }
        },
    
        sticky_header: function () {
                    if(jot_shop.jot_shop_sticky_header_effect=='scrldwmn'){
                    var position = jQuery(window).scrollTop(); 
                    var $headerBar = jQuery('header').height();
                    // should start at 0
                    jQuery(window).scroll(function() {
                        var scroll = jQuery(window).scrollTop();
                        if(scroll > position || scroll < $headerBar) {
                        jQuery(".sticky-header").removeClass("stick");
                        $(".search-wrapper").removeClass("open");
                        }else{
                        jQuery(".sticky-header").addClass("stick");
                        }
                        position = scroll;
                    });
                  }else{
                      jQuery(document).on("scroll", function(){
                      var $headerBar = jQuery('header').height();
                        if(jQuery(document).scrollTop() > $headerBar){
                            jQuery(".sticky-header").addClass("stick");
                          }else{
                            $(".search-wrapper").removeClass("open");
                            jQuery(".sticky-header").removeClass("stick");
                        } 
                       });
                  }
        },
        sticky_product_search: function () {
 
                  $('.prd-search').on('click', function (e) {
                     e.preventDefault();
                    $(".search-wrapper").addClass("open");
                  });
                  $('.search-close-btn').on('click', function (e) {
                     e.preventDefault();
                    $(".search-wrapper").removeClass("open");
                  });   
            
        },
          cat_toggle : function () { 
                    $('.header__cat__item.dropdown').on('click', function (e) {
                    e.preventDefault();
                    $(this).toggleClass('open');
                    });

          },

         
          
          pre_loader : function (){
                               if(!$('body').hasClass('elementor-editor-active')){
                                $(window).on('load', function(){
                                setTimeout(removeLoader); //wait for page load PLUS two seconds.
                                });
                                function removeLoader(){
                                    $( ".jot_shop_overlayloader" ).fadeOut(700, function(){
                                      // fadeOut complete. Remove the loading div
                                   $(".jot-shop-pre-loader img" ).hide(); //makes page more lightweight
                                    });  
                                  }
                                }

          },

          sideabr_toggle: function () {
                    $(document).ready(function() {
                          if ($(window).width() <= 990) { 
                          $('.sidebar-content-area .widget-title, .sidebar-content-area .wp-block-group h2').click(function() {
                          $(this).next().slideToggle();
                          $(this).toggleClass("open");
                          });
                         
                          }     
                });
                         
        },
        
        CatMenu : function () {
                 // category toggle
                              $(".cat-toggle").on("click keypress",function(e){
                              $(".product-cat-list").slideToggle();
                              $(".toggle-icon", this).toggleClass("icon-circle-arrow-down");
                               e.stopPropagation();
                              });

                              $(".product-cat-list").click(function(e){
                                  e.stopPropagation();
                              });
                              
                              $(document).on('click', function (e) {
                          if ($(e.target).closest(".cat-toggle").length === 0) {
                              $(".product-cat-list").slideUp();
                              $(".toggle-icon").removeClass("icon-circle-arrow-down");
                          }
});
                           
                           
                             $("#mobile-nav-tab-category .mobile").ThunkCatMenu({
                                 resizeWidth:'1024', // Set the same in Media query       
                                 animationSpeed:'fast', //slow, medium, fast
                                 accoridonExpAll:true//Expands all the accordion menu on click
                             });
                             $(".product-cat-list").ThunkCatMenu({
                                 resizeWidth:'767', // Set the same in Media query       
                                 animationSpeed:'fast', //slow, medium, fast
                                 accoridonExpAll:true//Expands all the accordion menu on click
                             });
                              $(".thunk-product-cat-list.slider").ThunkCatMenu({
                                 resizeWidth:'767', // Set the same in Media query       
                                 animationSpeed:'fast', //slow, medium, fast
                                 accoridonExpAll:true//Expands all the accordion menu on click
                             });
        },
        DefaultMenu: function(){
                 $("#menu-all-pages.jot-shop-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
             });
                 $(".menu ul.jot-shop-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
             });
                  $("#mobile-nav-tab-menu #menu-all-pages.jot-shop-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
             });
                  $("#mobile-nav-tab-menu .menu ul.jot-shop-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
             });
        },
        MainMenu : function(){
                $("#jot-shop-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
            });
                $("#mobile-nav-tab-menu #jot-shop-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
            });
        },
        StickMenu : function(){
                $("#jot-shop-stick-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
            });
        },
        AboveMenu : function(){
                $("#open-above-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
             });    
             $("#mobile-nav-tab-menu #open-above-menu").jotShopResponsiveMenu({
                 resizeWidth:'1024', // Set the same in Media query       
                 animationSpeed:'medium', //slow, medium, fast
                 accoridonExpAll:true//Expands all the accordion menu on click
            }); 
        
        },
        
        MobileMenuFunction : function(){
                 // close-button-active
                   $('body').find('.sider').prepend('<div class="menu-close"><a href="#" class="menu-close-btn">close</a></div>');
                        $('.menu-close-btn').removeAttr("href");
                        //Menu close
                        $('.menu-close-btn,.jot-shop-menu li a span.jot-shop-menu-link').click(function(){
                        $('body').removeClass('mobile-menu-active');
                        $('body').removeClass('sticky-mobile-menu-active');
                        });
                         $('.menu-close-btn,.jot-shop-menu li a span.jot-shop-menu-link').keypress(function(){
                        $('body').removeClass('mobile-menu-active');
                        $('body').removeClass('sticky-mobile-menu-active');
                        });
                        // Esc key close menu
                      document.addEventListener( 'keydown', function( event ) {
                      if ( event.keyCode === 27 ) {
                        event.preventDefault();
                        document.querySelectorAll( '.mobile-menu-active' ).forEach( function( element ) {
                          jQuery('body').removeClass('mobile-menu-active');
                        }.bind( this ) );
                      
                      }
                    }.bind( this ) );
                    //ToggleBtn above Click
                    $('#menu-btn-abv').click(function (e){
                       e.preventDefault();
                       $('body').addClass('mobile-above-menu-active');
                       $('#open-above-menu').removeClass('hide-menu'); 
                       $('.sider.above').removeClass('jot-shop-menu-hide');
                       $('.sider.main').addClass('jot-shop-menu-hide');
                       jotshopmenu.modalMenu.init(); 
                    });
                    //ToggleBtn main menu Click
                    $('#menu-btn,#mob-menu-btn').click(function (e){
                       e.preventDefault();
                       $('body').addClass('mobile-menu-active');
                       $('#jot-shop-menu').removeClass('hide-menu');
                       $('.sider.above').addClass('jot-shop-menu-hide');  
                       $('.sider.main').removeClass('jot-shop-menu-hide');
                       jotshopmenu.modalMenu.init();     
                    });
                     
                    //sticky
                    $('#menu-btn-stk').click(function (e){
                       e.preventDefault();
                       $('body').addClass('sticky-mobile-menu-active');
                       $('.sider.main').addClass('jot-shop-menu-hide');
                       jotshopmenu.modalMenu.init(); 
                      });
                    // default page
                    $('#menu-btn,#mob-menu-btn').click(function (e){
                       e.preventDefault();
                       $('body').addClass('mobile-menu-active');
                       $('#menu-all-pages').removeClass('hide-menu');  
                       jotshopmenu.modalMenu.init();   
                    });

                   
        },
          mobile_menu_with_woocat: function () {
                    $(document).ready(function() {
                        $('.mobile-nav-tabs li a').click(function(){
                         $('.panel').hide();
                         $('.mobile-nav-tabs li a.active').removeClass('active');
                         $(this).addClass('active');
                         var panel = $(this).attr('href');
                         $(panel).fadeIn(1000);
                         return false;  // prevents link action
                          });  // end click
                         $('.mobile-nav-tabs li:first a').click();
                });
        },
        Top2Slider:function(){
          if(jot_shop.jot_shop_rtl==true){
          var bgstr_rtl = true;
         }else{
          var bgstr_rtl = false;
         }

                      var owl = $('.thunk-top2-slide');
                           owl.owlCarousel({
                             rtl:bgstr_rtl,
                             items:1,
                             nav: true,
                             navText: ["<i class='brand-nav fa fa-angle-left'></i>",
                             "<i class='brand-nav fa fa-angle-right'></i>"],
                             loop:true,
                             dots: false,
                             smartSpeed:500,
                             autoHeight: false,
                             margin:0,
                             autoplay:jot_shop.jot_shop_top_slider_optn,
                             autoplayTimeout: parseInt(jot_shop.jot_shop_slider_speed),
                              autoplayHoverPause: true, // Stops autoplay
                             
                 });
                         // add animate.css class(es) to the elements to be animated
                        function setAnimation ( _elem, _InOut ) {
                          // Store all animationend event name in a string.
                          // cf animate.css documentation
                          var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                          _elem.each ( function () {
                            var $elem = $(this);
                            var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                            $elem.addClass($animationType).one(animationEndEvent, function () {
                              $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                            });
                          });
                        }

                      // Fired before current slide change
                        owl.on('change.owl.carousel', function(event) {
                            var $currentItem = $('.owl-item', owl).eq(event.item.index);
                            var $elemsToanim = $currentItem.find("[data-animation-out]");
                            setAnimation ($elemsToanim, 'out');
                        });

                      // Fired after current slide has been changed
                        var round = 0;
                        owl.on('changed.owl.carousel', function(event) {

                            var $currentItem = $('.owl-item', owl).eq(event.item.index);
                            var $elemsToanim = $currentItem.find("[data-animation-in]");
                          
                            setAnimation ($elemsToanim, 'in');
                        })
                        
                        owl.on('translated.owl.carousel', function(event) {
                          // console.log (event.item.index, event.page.count);
                          
                            if (event.item.index == (event.page.count - 1))  {
                              if (round < 1) {
                                round++
                                // console.log (round);
                              } else {
                                owl.trigger('stop.owl.autoplay');
                                var owlData = owl.data('owl.carousel');
                                owlData.settings.autoplay = false; //don't know if both are necessary
                                owlData.options.autoplay = false;
                                owl.trigger('refresh.owl.carousel');
                              }
                            }
                        });
                          
        },
        TopMultiSlide:function(){
                if(jot_shop.jot_shop_rtl==true){
                  var bgstr_rtl = true;
                }else{
                  var bgstr_rtl = false;
                }
                if(jot_shop.jot_shop_top_slider_optn == true){
                var sld_atply_p = true;
                }else{
                var sld_atply_p = false; 
                }
               
                var owl = $('.thunk-slider-multi-slide');
                     owl.owlCarousel({
                       rtl:bgstr_rtl,
                       items:4,
                       nav: false,
                       loop:sld_atply_p,
                       dots: false,
                       smartSpeed: 1800,
                       autoHeight: false,
                       margin:15,
                       autoplay:sld_atply_p,
                       autoplayHoverPause: true, // Stops autoplay
                       autoplayTimeout: 3000,
                       responsive:{
                        0:{
                                           items:2,
                                           margin:7.5,
                                       },
                                       768:{
                                           items:2,
                                       },
                                       900:{
                                           items:3,
                                       },
                                       1025:{
                                           items:4,
                         }
                   }
                });

           },
           TopFullSlide:function(){
                if(jot_shop.jot_shop_rtl==true){
                  var bgstr_rtl = true;
                }else{
                  var bgstr_rtl = false;
                }
                if(jot_shop.jot_shop_top_slider_optn == true){
                var sld_atply_p = true;
                }else{
                var sld_atply_p = false; 
                }
                
                var owl = $('.thunk-slider-full-slide');
                     owl.owlCarousel({
                        rtl:bgstr_rtl,
                       items:1,
                       nav: false,
                       loop:sld_atply_p,
                       dots: true,
                       smartSpeed: 1800,
                       autoHeight: false,
                       margin:0,
                       autoplay:sld_atply_p,
                       autoplayHoverPause: true, // Stops autoplay
                       autoplayTimeout: 3000,
                       responsive:{
                        0:{
                                           items:1,
                                           
                                       },
                                       768:{
                                           items:1,
                                       },
                                       900:{
                                           items:1,
                                       },
                                       1025:{
                                           items:1,
                         }
                   }
                });

           },


           

            MoveToTop:function(){
                      /**************************************************/
                      // Show-hide Scroll to top & move-to-top arrow
                      /**************************************************/
                        jQuery("body").prepend("<a id='move-to-top' class='animate' href='#'><i class='fa fa-angle-up'></i></a>"); 
                        var scrollDes = 'html,body';  
                        /*Opera does a strange thing if we use 'html' and 'body' together so my solution is to do the UA sniffing thing*/
                        if(navigator.userAgent.match(/opera/i)){
                          scrollDes = 'html';
                        }
                        //show ,hide
                        jQuery(window).scroll(function (){
                          if(jQuery(this).scrollTop() > 160){
                            jQuery('#move-to-top').addClass('filling').removeClass('hiding');
                          }else{
                            jQuery('#move-to-top').removeClass('filling').addClass('hiding');
                          }
                        });
                        jQuery('#move-to-top').click(function(){
                            jQuery("html, body").animate({ scrollTop: 0 }, 600);
                            return false;
                        });
                     
                },
                

               MobilenavBar:function(){
                 //show ,hide
                        jQuery(window).scroll(function (){
                          if(jQuery(this).scrollTop() > 160){
                            jQuery('#jotshop-mobile-bar').addClass('active').removeClass('hiding');
                              if($(window).scrollTop() + window.innerHeight >= document.body.scrollHeight){
                                  jQuery('#jotshop-mobile-bar').removeClass('active');
                                }
    $('window').on('touchmove', function(event) {
    //Prevent the window from being scrolled.
    event.preventDefault();

   if($(window).scrollTop() + window.innerHeight >= document.body.scrollHeight){
                                  jQuery('#jotshop-mobile-bar').removeClass('active');
                                }
});
                          }else{
                            jQuery('#jotshop-mobile-bar').removeClass('active').addClass('hiding');
                          }

                        });
                   },     
    }
/* -----------------------------------------------------------------------------------------------
  Modal Menu
--------------------------------------------------------------------------------------------------- */
var jotshopmenu = jotshopmenu || {};
jotshopmenu.modalMenu = {
  init: function(){
    this.keepFocusInModal();
  },
    keepFocusInModal: function(){
    var _doc = document;
    _doc.addEventListener( 'keydown', function( event ){
      var toggleTarget, modal, selectors, elements, menuType, bottomMenu, activeEl, lastEl, firstEl, tabKey, shiftKey,
        toggleTarget = '.mobile-nav-bar.sider';
        if(jQuery('.mobile-menu-active').length!=''){   
        selectors = 'a,.arrow';
        modal = _doc.querySelector( toggleTarget );
        elements = modal.querySelectorAll( selectors );
        elements = Array.prototype.slice.call( elements );
        if ( '.mobile-nav-bar.sider' === toggleTarget ){
          menuType = window.matchMedia( '(min-width: 1024px)' ).matches;
          menuType = menuType ? '.expanded-menu' : '.mobile-nav-tab-menu .jot-shop-menu';
          elements = elements.filter( function( element ) {
            return null !== element.closest( menuType ) && null !== element.offsetParent;
          } );
          elements.unshift( _doc.querySelector( '.mobile-nav-bar .menu-close-btn' ) );
           $('.mobile-nav-tab-menu .jot-shop-menu a,.mobile-nav-bar .menu-close-btn,.mobile-nav-bar .arrow').attr('tabindex',0); 
        }
        lastEl = elements[ elements.length - 1 ];
        firstEl = elements[0];
        activeEl = _doc.activeElement;
        tabKey = event.keyCode === 9;
        shiftKey = event.shiftKey;

        if ( ! shiftKey && tabKey && lastEl === activeEl ) {
          event.preventDefault();
          firstEl.focus();
        }

        if ( shiftKey && tabKey && firstEl === activeEl ) {
          event.preventDefault();
          lastEl.focus();
        }
      }

    } );
  }
}; // jotshopmenu.modalMenu   
   
JotShopLib.init();
  $(".menu-close-btn").click(function(){
    // focus and select
   $('.menu-toggle .menu-btn').focus().select();
   $('.jot-shop-menu a,.menu-close,.arrow').attr('tabindex',-1);
});
$(".menu-close-btn").keypress(function(){
   
    // focus and select
   $('.menu-toggle .menu-btn').focus().select();
   $('.jot-shop-menu a,.menu-close,.arrow').attr('tabindex',-1);
});
})(jQuery);


