'use strict';

class StickyHeader {
  constructor() {
    if (typeof greenmart_settings === "undefined") return;

    let _this = this;

    if (greenmart_settings.skin_elementor) {
      this.$tbayHeader = $('.tbay_header-template');
      this.$tbayHeaderMain = $('.tbay_header-template .header-main');

      if (this.$tbayHeader.hasClass('main-sticky-header') && this.$tbayHeaderMain.length > 0) {
        _this._initStickyHeader();
      }

      let sticky_header = $('.element-sticky-header');

      if (sticky_header.length > 0) {
        _this._initELementStickyheader(sticky_header);
      }
    } else {
      _this._initStickyHeaderWPBakery();
    }
  }

  _initStickyHeaderWPBakery() {
    var tbay_header = jQuery('#tbay-header');

    if (tbay_header.hasClass('main-sticky-header')) {
      var tbay_width = jQuery(window).width();
      var header_height = tbay_header.height();
      var header_height_fixed = jQuery('#tbay-header.sticky-header1').height();

      if (greenmart_settings.active_theme == 'restaurant') {
        header_height = 0;
      }

      $(window).scroll(function () {
        if (tbay_width >= 1024) {
          var NextScroll = jQuery(this).scrollTop();

          if (NextScroll > header_height) {
            if (tbay_header.hasClass('sticky-header1')) return;
            tbay_header.addClass('sticky-header1');
            tbay_header.parent().css('margin-top', header_height);
            tbay_header.addClass('sticky-header1').css("top", jQuery('#wpadminbar').outerHeight());
          } else {
            tbay_header.removeClass('sticky-header1');
            tbay_header.parent().css('margin-top', 0);
          }
        }
      });
    }
  }

  _initStickyHeader() {
    var _this = this;

    var tbay_width = $(window).width();

    var header_height = _this.$tbayHeader.outerHeight();

    var headerMain_height = _this.$tbayHeaderMain.outerHeight();

    var admin_height = $('#wpadminbar').length > 0 ? $('#wpadminbar').outerHeight() : 0;

    var sticky = _this.$tbayHeaderMain.offset().top;

    if (tbay_width >= 1024) {
      if (sticky == 0 || sticky == admin_height) {
        if (_this.$tbayHeader.hasClass('sticky-header')) return;

        _this._stickyHeaderOnDesktop(headerMain_height, sticky, admin_height);

        _this.$tbayHeaderMain.addClass('sticky-1');

        $(window).scroll(function () {
          if ($(this).scrollTop() > header_height) {
            _this.$tbayHeaderMain.addClass('sticky-box');
          } else {
            _this.$tbayHeaderMain.removeClass('sticky-box');
          }
        });
      } else {
        $(window).scroll(function () {
          if (!_this.$tbayHeader.hasClass('main-sticky-header')) return;

          if ($(this).scrollTop() > sticky - admin_height) {
            if (_this.$tbayHeader.hasClass('sticky-header')) return;

            _this._stickyHeaderOnDesktop(headerMain_height, sticky, admin_height);
          } else {
            _this.$tbayHeaderMain.css("top", 0).css("position", "relative").removeClass('sticky-header').parent().css('padding-top', 0);

            _this.$tbayHeaderMain.prev().css('margin-bottom', 0);
          }
        });
      }
    }
  }

  _stickyHeaderOnDesktop(headerMain_height, sticky, admin_height) {
    this.$tbayHeaderMain.addClass('sticky-header').css("top", admin_height).css("position", "fixed");

    if (sticky == 0 || sticky == admin_height) {
      this.$tbayHeaderMain.parent().css('padding-top', headerMain_height);
    } else {
      this.$tbayHeaderMain.prev().css('margin-bottom', headerMain_height);
    }
  }

  _initELementStickyheader(elements) {
    var el = elements.first();

    let _this = this;

    var scroll = false,
        sum = 0,
        prev_sum = 0;
    if (el.parents('.tbay_header-template').length === 0) return;
    var adminbar = $('#wpadminbar').length > 0 ? $('#wpadminbar').outerHeight() : 0,
        sticky_load = el.offset().top - $(window).scrollTop() - adminbar,
        sticky = sticky_load;
    el.prevAll().each(function () {
      prev_sum += $(this).outerHeight();
    });
    elements.each(function () {
      if ($(this).parents('.element-sticky-header').length > 0) return;
      sum += $(this).outerHeight();
    });

    _this._initELementStickyheaderContent(sticky_load, sticky, sum, prev_sum, elements, el, adminbar, scroll);

    $(window).scroll(function () {
      scroll = true;
      if ($(window).scrollTop() === 0) sticky = 0;

      _this._initELementStickyheaderContent(sticky_load, sticky, sum, prev_sum, elements, el, adminbar, scroll);
    });
  }

  _initELementStickyheaderContent(sticky_load, sticky, sum, prev_sum, elements, el, adminbar, scroll) {
    let sum_has = el.prev().length > 0 ? prev_sum : 1;

    if ($(window).scrollTop() >= sum_has) {
      el.parent().addClass('has-header-sticky');
    } else {
      el.parent().removeClass('has-header-sticky');
    }

    if ($(window).scrollTop() < prev_sum && scroll || $(window).scrollTop() === 0 && scroll) {
      if (el.parent().children().first().hasClass('element-sticky-header')) return;
      el.css('top', '');

      if (sticky === sticky_load || sticky === 0) {
        elements.last().next().css('padding-top', '');
      } else {
        el.prev().css('margin-bottom', '');
      }

      el.parent().css('padding-top', '');
      elements.last().removeClass('last-sticky');
      elements.each(function () {
        $(this).removeClass("sticky");

        if ($(this).prev('.element-sticky-header').length > 0) {
          $(this).css('top', '');
        }
      });
    } else {
      if ($(window).scrollTop() < prev_sum && !scroll) return;
      elements.last().addClass('last-sticky');
      elements.each(function () {
        if ($(this).parents('.element-sticky-header').length > 0) return;
        $(this).addClass("sticky");

        if ($(this).prevAll('.element-sticky-header').length > 0) {
          let total = 0;
          $(this).prevAll('.element-sticky-header').each(function () {
            total += $(this).outerHeight();
          });
          $(this).css('top', total + adminbar);
        }
      });
      el.css('top', adminbar);

      if (sticky === sticky_load || sticky === 0) {
        el.addClass("sticky");
        el.parent().css('padding-top', sum);
      } else {
        el.prev().css('margin-bottom', sum);
      }
    }
  }

}

const DEVICE = {
  ANDROID: /Android/i,
  BLACK_BERRY: /BlackBerry/i,
  IOS: /iPhone|iPad|iPod/i,
  OPERA: /Opera Mini/i,
  WINDOW: /IEMobile/i,
  ANY: /Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i
};

let isDevice = device => {
  navigator.userAgent.match(device);
};

class Mobile {
  constructor() {
    this._removeActiveMobileMenu();

    this._topBarDevice();

    this._fixVCAnimation();

    this._categoryMenu();

    this._mobileMenu();

    this._searchMobileShow();

    $(window).scroll(() => {
      this._topBarDevice();

      this._fixVCAnimation();
    });
  }

  _removeActiveMobileMenu() {
    let $win = $(window);
    let $box = $('#tbay-mobile-menu,.topbar-device-mobile .active-mobile,#tbay-header.header-v4 .header-main .tbay-mainmenu .btn-offcanvas,#tbay-header.header-v5 .header-main .tbay-mainmenu .btn-offcanvas,.topbar-mobile .btn.btn-offcanvas,.wrapper-container .tbay-offcanvas');
    $win.on("click.Bst,click touchstart tap", function (event) {
      if ($box.has(event.target).length == 0 && !$box.is(event.target)) {
        $('.wrapper-container').removeClass('active');
        $('#tbay-mobile-menu').removeClass('active');
      }
    });
  }

  _topBarDevice() {
    if (!greenmart_settings.mobile) return;
    var scroll = $(window).scrollTop();
    var objectSelect = $(".topbar-device-mobile").height();
    var scrollmobile = $(window).scrollTop();
    $(".topbar-device-mobile").toggleClass("active", scroll <= objectSelect);
    $("#tbay-mobile-menu, #tbay-mobile-menu-navbar").toggleClass("offsetop", scrollmobile == 0);
    var objectSelect_adminbar = $("#wpadminbar");

    if (objectSelect_adminbar.length > 0) {
      $("body").toggleClass("active-admin-bar", scrollmobile == 0);
    }
  }

  _fixVCAnimation() {
    if ($(".wpb_animate_when_almost_visible").length > 0 && !$(".wpb_animate_when_almost_visible").hasClass('wpb_start_animation')) {
      let animate_height = $(window).height();
      let wpb_not_animation_element = $(".wpb_animate_when_almost_visible:not(.wpb_start_animation)");
      var next_scroll = wpb_not_animation_element.offset().top - $(window).scrollTop();

      if (isDevice(DEVICE.ANY)) {
        wpb_not_animation_element.removeClass('wpb_animate_when_almost_visible');
      } else if (next_scroll < animate_height - 50) {
        wpb_not_animation_element.addClass("wpb_start_animation animated");
      }
    }
  }

  _categoryMenu() {
    $(".category-inside .category-inside-title").on("click", function () {
      $(this).parents('.category-inside').find(".category-inside-content").slideToggle("fast");
      $(this).parents('.category-inside').toggleClass("open");
    });
  }

  _mobileMenu() {
    $('[data-toggle="offcanvas"], .btn-offcanvas').on('click', function () {
      $('#wrapper-container').toggleClass('active');
      $('#tbay-mobile-menu').toggleClass('active');
    });
    $("#main-mobile-menu .caret").on('click', function (event) {
      $("#main-mobile-menu .dropdown").removeClass('open');
      $(event.target).parent().addClass('open');
    });
  }

  _searchMobileShow() {
    $(document).off('click', '.topbar-device-mobile .search-device .show-search').on('click', '.topbar-device-mobile .search-device .show-search', function (e) {
      e.preventDefault();
      $(".topbar-device-mobile .search-device .tbay-search-form").slideToggle(500, function () {});
    });
    $(document).off('click', '.topbar-mobile-right .search-device .show-search').on('click', '.topbar-mobile-right .search-device .show-search', function (e) {
      e.preventDefault();
      $(".topbar-mobile-right .search-device .tbay-search-form").slideToggle(500, function () {});
    });
  }

}

class AccountMenu {
  constructor() {
    this._slideToggleAccountMenu(".tbay-login");

    this._slideToggleAccountMenu(".topbar-mobile");

    this._clickNotMyAccountMenu();

    this._accountButton();
  }

  _clickNotMyAccountMenu() {
    var $win_my_account = $(window);
    var $box_my_account = $('.tbay-login .dropdown .account-menu,.topbar-mobile .dropdown .account-menu,.tbay-login .dropdown .account-button,.topbar-mobile .dropdown .account-button');
    $win_my_account.on("click.Bst", function (event) {
      if ($box_my_account.has(event.target).length == 0 && !$box_my_account.is(event.target)) {
        $(".tbay-login .dropdown .account-menu").slideUp(500);
        $(".topbar-mobile .dropdown .account-menu").slideUp(500);
      }
    });
  }

  _slideToggleAccountMenu(parentSelector) {
    $(parentSelector).find(".dropdown .account-button").on('click', function () {
      $(parentSelector).find(".dropdown .account-menu").slideToggle(500);
    });
  }

  _accountButton() {
    $(".tbay-login .dropdown .account-button").on("click", function () {
      $(".tbay-login .dropdown .account-menu").slideToggle(500, function () {});
    });
    $(".topbar-mobile .dropdown .account-button").on("click", function () {
      $(".topbar-mobile .dropdown .account-menu").slideToggle(500, function () {});
    });
  }

}

class BackToTop {
  constructor() {
    this._init();
  }

  _init() {
    $(window).scroll(function () {
      var isActive = $(this).scrollTop() > 400;
      $('.tbay-to-top').toggleClass('active', isActive);
      $('.tbay-category-fixed').toggleClass('active', isActive);
    });
    $('#back-to-top').on('click', this._onClickBackToTop);
  }

  _onClickBackToTop() {
    $('html, body').animate({
      scrollTop: '0px'
    }, 800);
  }

}

class CanvasMenu {
  constructor() {
    this._initCanvasMenu();
  }

  _initCanvasMenu() {
    let menu_canvas = $(".element-menu-canvas");
    if (menu_canvas.length === 0) return;
    menu_canvas.each(function () {
      jQuery(this).find('.canvas-menu-btn-wrapper > a').on('click', function (event) {
        $(this).parent().parent().addClass('open');
        event.stopPropagation();
      });
    });
    jQuery(document).on('click', '.canvas-overlay-wrapper', function (event) {
      $(this).parent().removeClass('open');
      event.stopPropagation();
    });
    jQuery(document).on('click', '.toggle-canvas-close', function (event) {
      $(this).parents('.element-menu-canvas').removeClass('open');
      event.stopPropagation();
    });
  }

}

(function ($) {
  $.extend($.fn, {
    swapClass: function (c1, c2) {
      var c1Elements = this.filter('.' + c1);
      this.filter('.' + c2).removeClass(c2).addClass(c1);
      c1Elements.removeClass(c1).addClass(c2);
      return this;
    },
    replaceClass: function (c1, c2) {
      return this.filter('.' + c1).removeClass(c1).addClass(c2).end();
    },
    hoverClass: function (className) {
      className = className || "hover";
      return this.on("hover", function () {
        $(this).addClass(className);
      }, function () {
        $(this).removeClass(className);
      });
    },
    heightToggle: function (animated, callback) {
      animated ? this.animate({
        height: "toggle"
      }, animated, callback) : this.each(function () {
        jQuery(this)[jQuery(this).is(":hidden") ? "show" : "hide"]();
        if (callback) callback.apply(this, arguments);
      });
    },
    heightHide: function (animated, callback) {
      if (animated) {
        this.animate({
          height: "hide"
        }, animated, callback);
      } else {
        this.hide();
        if (callback) this.each(callback);
      }
    },
    prepareBranches: function (settings) {
      if (!settings.prerendered) {
        this.filter(":last-child:not(ul)").addClass(CLASSES.last);
      }

      return this.filter(":has(>ul),:has(>.dropdown-menu)");
    },
    applyClasses: function (settings, toggler) {
      this.filter(":has(>ul):not(:has(>a))").find(">span").on("click", function (event) {
        toggler.apply($(this).next());
      }).add($("a", this)).hoverClass();

      if (!settings.prerendered) {
        this.filter(":has(>ul:hidden),:has(>.dropdown-menu:hidden)").addClass(CLASSES.expandable).replaceClass(CLASSES.last, CLASSES.lastExpandable);
        this.not(":has(>ul:hidden),:has(>.dropdown-menu:hidden)").addClass(CLASSES.collapsable).replaceClass(CLASSES.last, CLASSES.lastCollapsable);
        this.prepend("<div class=\"" + CLASSES.hitarea + "\"/>").find("div." + CLASSES.hitarea).each(function () {
          var classes = "";
          $.each($(this).parent().attr("class").split(" "), function () {
            classes += this + "-hitarea ";
          });
          $(this).addClass(classes);
        });
      }

      this.find("div." + CLASSES.hitarea).on("click", toggler);
    },
    treeview: function (settings) {
      settings = $.extend({
        cookieId: "treeview"
      }, settings);

      if (settings.add) {
        return this.trigger("add", [settings.add]);
      }

      if (settings.toggle) {
        var callback = settings.toggle;

        settings.toggle = function () {
          return callback.apply($(this).parent()[0], arguments);
        };
      }

      function treeController(tree, control) {
        function handler(filter) {
          return function () {
            toggler.apply($("div." + CLASSES.hitarea, tree).filter(function () {
              return filter ? $(this).parent("." + filter).length : true;
            }));
            return false;
          };
        }

        $("a:eq(0)", control).on("click", handler(CLASSES.collapsable));
        $("a:eq(1)", control).on("click", handler(CLASSES.expandable));
        $("a:eq(2)", control).on("click", handler());
      }

      function toggler() {
        $(this).parent().find(">.hitarea").swapClass(CLASSES.collapsableHitarea, CLASSES.expandableHitarea).swapClass(CLASSES.lastCollapsableHitarea, CLASSES.lastExpandableHitarea).end().swapClass(CLASSES.collapsable, CLASSES.expandable).swapClass(CLASSES.lastCollapsable, CLASSES.lastExpandable).find(">ul,>.dropdown-menu").heightToggle(settings.animated, settings.toggle);

        if (settings.unique) {
          $(this).parent().siblings().find(">.hitarea").replaceClass(CLASSES.collapsableHitarea, CLASSES.expandableHitarea).replaceClass(CLASSES.lastCollapsableHitarea, CLASSES.lastExpandableHitarea).end().replaceClass(CLASSES.collapsable, CLASSES.expandable).replaceClass(CLASSES.lastCollapsable, CLASSES.lastExpandable).find(">ul,>.dropdown-menu").heightHide(settings.animated, settings.toggle);
        }
      }

      function serialize() {

        var data = [];
        branches.each(function (i, e) {
          data[i] = $(e).is(":has(>ul:visible)") ? 1 : 0;
        });
        $.cookie(settings.cookieId, data.join(""));
      }

      function deserialize() {
        var stored = $.cookie(settings.cookieId);

        if (stored) {
          var data = stored.split("");
          branches.each(function (i, e) {
            $(e).find(">ul")[parseInt(data[i]) ? "show" : "hide"]();
          });
        }
      }

      this.addClass("treeview");
      var branches = this.find("li").prepareBranches(settings);

      switch (settings.persist) {
        case "cookie":
          var toggleCallback = settings.toggle;

          settings.toggle = function () {
            serialize();

            if (toggleCallback) {
              toggleCallback.apply(this, arguments);
            }
          };

          deserialize();
          break;

        case "location":
          var current = this.find("a").filter(function () {
            return this.href.toLowerCase() == location.href.toLowerCase();
          });

          if (current.length) {
            current.addClass("selected").parents("ul, li").add(current.next()).show();
          }

          break;
      }

      branches.applyClasses(settings, toggler);

      if (settings.control) {
        treeController(this, settings.control);
        $(settings.control).show();
      }

      return this.bind("add", function (event, branches) {
        $(branches).prev().removeClass(CLASSES.last).removeClass(CLASSES.lastCollapsable).removeClass(CLASSES.lastExpandable).find(">.hitarea").removeClass(CLASSES.lastCollapsableHitarea).removeClass(CLASSES.lastExpandableHitarea);
        $(branches).find("li").andSelf().prepareBranches(settings).applyClasses(settings, toggler);
      });
    }
  });
  var CLASSES = $.fn.treeview.classes = {
    open: "open1",
    closed: "closed",
    expandable: "expandable",
    expandableHitarea: "expandable-hitarea",
    lastExpandableHitarea: "lastExpandable-hitarea",
    collapsable: "collapsable",
    collapsableHitarea: "collapsable-hitarea",
    lastCollapsableHitarea: "lastCollapsable-hitarea",
    lastCollapsable: "lastCollapsable",
    lastExpandable: "lastExpandable",
    last: "last",
    hitarea: "hitarea"
  };
  $.fn.Treeview = $.fn.treeview;
})(jQuery);

class FuncCommon {
  constructor() {
    var _this = this;

    _this._fancyboxVideo();

    _this._progressAnimation();

    _this._createWrapStart();

    $('.mod-heading .widget-title > span').wrapStart();

    _this._greenmartResizeMegamenu();

    $(window).on("resize", () => {
      _this._greenmartResizeMegamenu();

      _this._fixFull();
    });
    setTimeout(function () {
      jQuery(document.body).on('tbay_load_html_click', () => {
        _this._greenmartResizeMegamenu();
      });
    }, 2000);

    _this._fixFull();

    _this._intTooltip();

    _this._categoryV6Inside();

    _this._fixSliderHome3();

    _this._toCategoryFixed();

    _this._homeBanner();

    _this._toggleDropdown();

    if (greenmart_settings.skin_elementor_fresh) {
      _this._initHeaderCoverbgFresh();
    }
  }

  _fancyboxVideo() {
    $(".fancybox-video").fancybox({
      maxWidth: 800,
      maxHeight: 600,
      fitToView: false,
      width: '70%',
      height: '70%',
      autoSize: false,
      closeClick: false,
      openEffect: 'none',
      closeEffect: 'none'
    });
    $(".fancybox").fancybox();
  }

  _createWrapStart() {
    $.fn.wrapStart = function () {
      return this.each(function () {
        var $this = $(this);
        var node = $this.contents().filter(function () {
          return this.nodeType == 3;
        }).first(),
            text = node.text().trim(),
            first = text.split(' ', 1).join(" ");
        if (!node.length) return;
        node[0].nodeValue = text.slice(first.length);
        node.before('<b>' + first + '</b>');
      });
    };
  }

  _initHeaderCoverbgFresh() {
    let menu = $('.tbay-horizontal .navbar-nav > li,.tbay-horizontal-default .navbar-nav > li, .tbay_header-template .product-recently-viewed-header'),
        search = $('.tbay-search-form .tbay-search'),
        btn_category = $('.category-inside .category-inside-title'),
        cart_click = $('.cart-popup');
    menu.mouseenter(function () {
      if ($(this).parents('#tbay-header').length === 0) return;
      if ($(this).children('.dropdown-menu, ul, .content-view').length == 0) return;
      $('.tbay_header-template').addClass('nav-cover-active-1');
    }).mouseleave(function () {
      if ($(this).closest('.dropdown-menu').length) return;
      $('.tbay_header-template').removeClass('nav-cover-active-1');
    });
    search.focusin(function () {
      if ($(this).closest('.dropdown-menu').length) return;
      if (search.parents('.sidebar-canvas-search').length > 0 || $(this).closest('.tbay_header-template').length === 0) return;
      $('.tbay_header-template').addClass('nav-cover-active-2');
    }).focusout(function () {
      $('.tbay_header-template').removeClass('nav-cover-active-2');
    });
    cart_click.on('shown.bs.dropdown', function (event) {
      $(event.target).closest('.tbay_header-template').addClass('nav-cover-active-3');
    }).on('hidden.bs.dropdown', function (event) {
      $(event.target).closest('.tbay_header-template').removeClass('nav-cover-active-3');
    });

    if (btn_category.parents('.tbay_header-template')) {
      $(document.body).on('tbay_category_inside_open', () => {
        $('.tbay_header-template').addClass('nav-cover-active-4');
      });
      $(document.body).on('tbay_category_inside_close', () => {
        $('.tbay_header-template').removeClass('nav-cover-active-4');
      });
    }
  }

  _progressAnimation() {
    $("[data-progress-animation]").each(function () {
      var $this = $(this);
      $this.appear(function () {
        var delay = $this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1;
        if (delay > 1) $this.css("animation-delay", delay + "ms");
        setTimeout(function () {
          $this.animate({
            width: $this.attr("data-progress-animation")
          }, 800);
        }, delay);
      }, {
        accX: 0,
        accY: -50
      });
    });
  }

  _greenmartResizeMegamenu() {
    var window_size = $('body').innerWidth();

    if (window_size > 767) {
      if ($('.tbay_custom_menu').length > 0) {
        if ($('.tbay_custom_menu').hasClass('tbay-vertical-menu')) {
          var full_width = parseInt($('#main-container.container').innerWidth());
          var menu_width = parseInt($('.tbay-vertical-menu').innerWidth());
          var w = full_width - menu_width;
          $('.tbay-vertical-menu').find('.active-mega-menu').each(function () {
            $(this).children('.dropdown-menu').css('max-width', w + 'px');
            $(this).children('.dropdown-menu').css('width', full_width - 30 + 'px');
          });
        }
      }
    } else {
      if ($('.tbay_custom_menu').length > 0) {
        if ($('.tbay_custom_menu').hasClass('tbay-vertical-menu')) {
          $(".tbay-vertical-menu").treeview({
            animated: 300,
            collapsed: true,
            unique: true,
            hover: false
          });
        }
      }
    }
  }

  _fixFull() {
    var mainwidth = $('#tbay-main-content').width();
    var marginleft = ($('#tbay-main-content').width() - $('#tbay-main-content >.container').width()) / 2;
    $('.tb-full').css('width', mainwidth);
    $('.tb-full').css('max-width', mainwidth);

    if ($('body').hasClass("rtl")) {
      $('.tb-full').css('margin-right', -marginleft);
    } else {
      $('.tb-full').css('margin-left', -marginleft);
    }

    $('.tb-full >.vc_fluid').css('padding', 0);
  }

  _categoryV6Inside() {
    $(".category-v6 .category-inside-title").off().on("click", function () {
      $(this).parents('.category-v6').find(".menu-category-menu-container").slideToggle("fast");
      $(this).parents('.category-v6').toggleClass("open");
    });
  }

  _removeAnimateVisible() {
    let $with = jQuery(window).width();

    if ($with < 1024) {
      jQuery(".wpb_animate_when_almost_visible:not(.wpb_start_animation)").each(function () {
        jQuery(this).removeClass("wpb_animate_when_almost_visible");
      });
    }
  }

  _fixSliderHome3() {
    let $with = jQuery(window).width();
    let $main_container = $(".container").width();
    let $main_container_full = $(".container-full").width();
    var $width_sum_full = ($with - $main_container) / 2 - ($with - $main_container_full) / 2 - 30;

    if ($with > 1520) {
      let $width_sum2 = -$width_sum_full;
      $('.rev_slider .fix-laptop').css('margin-left', $width_sum2);
    } else {
      $('.rev_slider .fix-laptop').removeAttr('style');
    }
  }

  _intTooltip() {
    if (typeof jQuery.fn.tooltip === "undefined") return;
    jQuery('[data-toggle="tooltip"]').tooltip();
  }

  _toCategoryFixed() {
    let $with = $(window).width();
    let $main_container = $(".container").width();
    var $width_sum = ($with - $main_container) / 2;

    if ($width_sum >= 80) {
      var $width_sum2 = $width_sum - 80;

      if ($width_sum < 110) {
        if (jQuery('body').hasClass("rtl")) {
          $('.tbay-to-top').css({
            "left": $width_sum2,
            "right": "auto"
          });
          $('.tbay-category-fixed').css({
            "right": $width_sum2,
            "left": "auto"
          });
        } else {
          $('.tbay-to-top').css({
            "right": $width_sum2,
            "left": "auto"
          });
          $('.tbay-category-fixed').css({
            "left": $width_sum2,
            "right": "auto"
          });
        }
      } else {
        $('.tbay-to-top').removeAttr("style");
        $('.tbay-category-fixed').removeAttr("style");
      }

      $('.tbay-category-fixed').css('display', 'block');
      $('.tbay-to-top').css('display', 'block');
    } else {
      $('.tbay-category-fixed').css('display', 'none');
      $('.tbay-to-top').css('display', 'none');
    }
  }

  _intLoader() {
    $('#loader').delay(100).fadeOut(400, function () {
      $('body').removeClass('tbay-body-loading');
      $(this).remove();
    });
  }

  _homeBanner() {
    if ($('.tbay-home-banner').length > 0) {
      $('.tbay-home-banner').parents('.vc_row-fluid').addClass('position-img');
    }
  }

  _toggleDropdown() {
    $(document.body).on('click', '.nav [data-toggle="dropdown"]', function () {
      if (this.href && this.href != '#') {
        window.location.href = this.href;
      }
    });
    $(document.body).on('click', '.treeview [data-toggle="dropdown"]', function () {
      if (this.href && this.href != '#') {
        window.location.href = this.href;
      }
    });
  }

}

class TreeView {
  constructor() {
    this._treeViewMenu();

    this._mobileTreeView();

    this._categoryTreeView();

    this._tbayTreeViewMenu();
  }

  _treeViewMenu() {
    $(".treeview-menu .menu").treeview({
      animated: 300,
      collapsed: true,
      unique: true,
      persist: "location"
    });
  }

  _mobileTreeView() {
    $(".navbar-offcanvas #main-mobile-menu .treeview .hitarea").remove();
    $(".navbar-offcanvas #main-mobile-menu .treeview .sub-menu").css('display', 'none');
    $(".navbar-offcanvas #main-mobile-menu .treeview").removeClass('treeview');
    $(".navbar-offcanvas #main-mobile-menu").treeview({
      animated: 300,
      collapsed: true,
      unique: true,
      hover: false
    });
  }

  _categoryTreeView() {
    $(".category-inside-content #category-menu").addClass('treeview');
    $(".category-inside-content #category-menu").treeview({
      animated: 300,
      collapsed: true,
      unique: true,
      persist: "location"
    });
  }

  _tbayTreeViewMenu() {
    if (typeof $.fn.treeview === "undefined" || typeof $('.tbay-treeview') === "undefined") return;
    $(".tbay-treeview").each(function () {
      $(this).find('> ul').treeview({
        animated: 400,
        collapsed: true,
        unique: true,
        persist: "location"
      });
    });
  }

}

class NewsLetter {
  constructor() {
    this._init();
  }

  _init() {
    if (typeof jQuery.fn.modal === "undefined") return;
    $('#popupNewsletterModal').on('hidden.bs.modal', function () {
      Cookies.set('hiddenmodal', 1, {
        expires: 0.1,
        path: '/'
      });
    });
    setTimeout(function () {
      if (typeof Cookies.get('hiddenmodal') === "undefined" || Cookies.get('hiddenmodal') == "") {
        $('#popupNewsletterModal').modal('show');
      }
    }, 3000);
  }

}

class Search {
  constructor() {
    this._init();
  }

  _init() {
    this._greenmartSearchMobile();

    this._buttonClickSearch();

    this._searchToTop();

    this._searchHeaderv2();

    this._searchPopup();

    $('.button-show-search').on('click', () => $('.tbay-search-form').addClass('active'));
    $('.button-hidden-search').on('click', () => $('.tbay-search-form').removeClass('active'));
  }

  _greenmartSearchMobile() {
    $(".search-device").each(function () {
      $(this).find(".show-search").on('click', event => {
        event.preventDefault();
        var target = $(event.currentTarget);
        target.parent().toggleClass('open');
        target.parent().find(".tbay-search").focus();
        $(document.body).trigger('search_device_mobile');
      });
    });
    $(".search-mobile-close").each(function (index) {
      $(this).off().on("click", function () {
        $(this).prev().removeClass('open');
        $(this).parent().slideUp(500, function () {});
        $(this).parents('.search-device').removeClass('open');
      });
    });
    $('.topbar-mobile .dropdown-menu').on('click', function (e) {
      e.stopPropagation();
    });
  }

  _searchToTop() {
    $('.search-totop-wrapper .btn-search-totop').on('click', function () {
      $('.search-totop-content').toggleClass('active');
      $(this).toggleClass('active');
    });
    var $box_totop = $('.search-totop-wrapper .btn-search-totop, .search-totop-content');
    $(window).on("click.Bst", function (event) {
      if ($box_totop.has(event.target).length == 0 && !$box_totop.is(event.target)) {
        $('.search-totop-wrapper .btn-search-totop').removeClass('active');
        $('.search-totop-content').removeClass('active');
      }
    });
  }

  _buttonClickSearch() {
    $('.button-show-search').on("click", function () {
      $('.tbay-search-form').addClass('active');
      return false;
    });
    $('.button-hidden-search').on("click", function () {
      $('.tbay-search-form').removeClass('active');
      return false;
    });
  }

  _searchHeaderv2() {
    $("#tbay-header.header-v2 .header-search-v2 .btn-search-totop").on("click", function () {
      $("#tbay-header.header-v2 .header-search-v2 .tbay-search-form").slideToggle(500, function () {});
      $(this).toggleClass('active');
    });
  }

  _searchPopup() {
    $(".toogle-btn-search").on("click", function () {
      $(".tbay-element-search-popup .tbay-search-form").slideToggle(500, function () {});
      $(this).toggleClass('active');
    });
  }

}

class Preload {
  constructor() {
    this._init();
  }

  _init() {
    if ($.fn.jpreLoader) {
      var $preloader = $('.js-preloader');
      $preloader.jpreLoader({}, function () {
        $preloader.addClass('preloader-done');
        $('body').trigger('preloader-done');
        $(window).trigger('resize');
      });
    }

    $('.tbay-page-loader').delay(100).fadeOut(400, function () {
      $('body').removeClass('tbay-body-loading');
      $(this).remove();
    });

    if ($(document.body).hasClass('tbay-body-loader')) {
      setTimeout(function () {
        $(document.body).removeClass('tbay-body-loader');
        $('.tbay-page-loader').fadeOut(250);
      }, 300);
    }
  }

}

class Section {
  constructor() {
    this._tbayMegaMenu();

    this._tbayRecentlyView();
  }

  _tbayMegaMenu() {
    let menu = $('.elementor-widget-tbay-nav-menu');
    if (menu.length === 0) return;
    menu.find('.tbay-element-nav-menu').each(function () {
      if ($(this).data('wrapper').layout !== "horizontal") return;

      if (!$(this).closest('.elementor-top-column').hasClass('tbay-column-static')) {
        $(this).closest('.elementor-top-column').addClass('tbay-column-static');
      }

      if (!$(this).closest('section').hasClass('tbay-section-static')) {
        $(this).closest('section').addClass('tbay-section-static');
      }
    });
  }

  _tbayRecentlyView() {
    let recently = $('.tbay-element-product-recently-viewed');
    if (recently.length === 0) return;
    recently.each(function () {
      if ($(this).data('wrapper').layout !== "header") return;

      if (!$(this).closest('.elementor-top-column').hasClass('tbay-column-static')) {
        $(this).closest('.elementor-top-column').addClass('tbay-column-static');
      }

      if (!$(this).closest('.elementor-top-column').hasClass('tbay-column-recentlyviewed')) {
        $(this).closest('.elementor-top-column').addClass('tbay-column-recentlyviewed');
      }

      if (!$(this).closest('section').hasClass('tbay-section-recentlyviewed')) {
        $(this).closest('section').addClass('tbay-section-recentlyviewed');
      }

      if (!$(this).closest('section').hasClass('tbay-section-static')) {
        $(this).closest('section').addClass('tbay-section-static');
      }
    });
  }

}

class Tabs {
  constructor() {
    $('ul.nav-tabs li a').on('shown.bs.tab', event => {
      $(document.body).trigger('greenmart_tabs_carousel');
    });
  }

}

class Accordion {
  constructor() {
    this._init();
  }

  _init() {
    if ($('.single-product').length === 0) return;
    $('#accordion').on('shown.bs.collapse', function (e) {
      if (typeof greenmart_settings !== "undefined" && greenmart_settings.skin_elementor) {
        var offset = $(this).find('.collapse.show').prev('.tabs-title');
      } else {
        var offset = $(this).find('.collapse.in').prev('.tabs-title');
      }

      if (offset) {
        $('html,body').animate({
          scrollTop: $(offset).offset().top - 150
        }, 500);
      }
    });
  }

}

class MenuDropdownsAJAX {
  constructor() {
    if (typeof greenmart_settings === "undefined") return;

    this._initmenuDropdownsAJAX();
  }

  _initmenuDropdownsAJAX() {
    var _this = this;

    $('body').on('mousemove', function () {
      $('.menu').has('.dropdown-load-ajax').each(function () {
        var $menu = $(this);

        if ($menu.hasClass('dropdowns-loading') || $menu.hasClass('dropdowns-loaded')) {
          return;
        }

        if (!_this.isNear($menu, 50, event)) {
          return;
        }

        _this.loadDropdowns($menu);
      });
    });
  }

  loadDropdowns($menu) {
    var _this = this;

    $menu.addClass('dropdowns-loading');
    var storageKey = '',
        unparsedData = '',
        menu_mobile_id = '',
        format = '';

    if ($menu.closest('nav').attr('id') === 'tbay-mobile-menu-navbar') {
      if ($('#main-mobile-menu-mmenu-wrapper').length > 0) {
        menu_mobile_id += '_' + $('#main-mobile-menu-mmenu-wrapper').data('id');
      }

      if ($('#main-mobile-second-mmenu-wrapper').length > 0) {
        menu_mobile_id += '_' + $('#main-mobile-second-mmenu-wrapper').data('id');
      }

      storageKey = greenmart_settings.storage_key + '_megamenu_mobile' + menu_mobile_id;
      format = 'no-builder';
    } else {
      storageKey = greenmart_settings.storage_key + '_megamenu_' + $menu.closest('nav').find('ul').data('id');
      format = typeof $menu.closest('nav').find('ul').data('format') !== "undefined" ? $menu.closest('nav').find('ul').data('format') : '';
    }

    unparsedData = localStorage.getItem(storageKey);
    var storedData = false;
    var $items = $menu.find('.dropdown-load-ajax'),
        ids = [];
    $items.each(function () {
      ids.push($(this).find('.dropdown-html-placeholder').data('id'));
    });

    try {
      storedData = JSON.parse(unparsedData);
    } catch (e) {
      console.log('cant parse Json', e);
    }

    if (storedData) {
      _this.renderResults(storedData, $menu, format);

      if ($menu.attr('id') !== 'tbay-mobile-menu-navbar') {
        $menu.removeClass('dropdowns-loading').addClass('dropdowns-loaded');
      }
    } else {
      $.ajax({
        url: greenmart_settings.ajaxurl,
        data: {
          action: 'greenmart_load_html_dropdowns',
          ids: ids,
          format: format
        },
        dataType: 'json',
        method: 'POST',
        success: function (response) {
          if (response.status === 'success') {
            _this.renderResults(response.data, $menu, format);

            localStorage.setItem(storageKey, JSON.stringify(response.data));
          } else {
            console.log('loading html dropdowns returns wrong data - ', response.message);
          }
        },
        error: function () {
          console.log('loading html dropdowns ajax error');
        }
      });
    }
  }

  renderResults(data, $menu, format) {
    var _this = this;

    Object.keys(data).forEach(function (id) {
      _this.removeDuplicatedStylesFromHTML(data[id], function (html) {
        let html2 = html;

        if (format !== 'no-builder') {
          const regex1 = '<li[^>]*><a[^>]*href=["]' + window.location.href + '["]>.*?<\/a><\/li>';
          let content = html.match(regex1);

          if (content !== null) {
            let $url = content[0];
            let $class = $url.match(/(?:class)=(?:["']\W+\s*(?:\w+)\()?["']([^'"]+)['"]/g)[0].split('"')[1];
            let $class_new = $class + ' active';
            let $url_new = $url.replace($class, $class_new);
            html2 = html2.replace($url, $url_new);
          }
        }

        $menu.find('[data-id="' + id + '"]').replaceWith(html2);

        if ($menu.attr('id') !== 'tbay-mobile-menu-navbar') {
          $menu.addClass('dropdowns-loaded');
          setTimeout(function () {
            $menu.removeClass('dropdowns-loading');
          }, 1000);
        }
      });
    });
  }

  isNear($element, distance, event) {
    var left = $element.offset().left - distance,
        top = $element.offset().top - distance,
        right = left + $element.width() + 2 * distance,
        bottom = top + $element.height() + 2 * distance,
        x = event.pageX,
        y = event.pageY;
    return x > left && x < right && y > top && y < bottom;
  }

  removeDuplicatedStylesFromHTML(html, callback) {
    if (greenmart_settings.combined_css) {
      callback(html);
      return;
    } else {
      const regex = /<style>.*?<\/style>/mg;
      let output = html.replace(regex, "");
      callback(output);
      return;
    }
  }

}

class MenuClickAJAX {
  constructor() {
    if (typeof greenmart_settings === "undefined") return;

    this._initmenuClickAJAX();
  }

  _initmenuClickAJAX() {
    $('.element-menu-ajax.ajax-active').each(function () {
      var $menu = $(this);
      $menu.find('.menu-click').off('click').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        if (!$this.closest('.element-menu-ajax').hasClass('ajax-active')) return;
        var element = $this.closest('.tbay-element'),
            type_menu = element.data('wrapper')['type_menu'],
            layout = element.data('wrapper')['layout'],
            header_type = element.data('wrapper')['header_type'];

        if (type_menu === 'toggle') {
          var nav = element.find('.category-inside-content > nav');
        } else {
          var nav = element.find('.menu-canvas-content > nav');
        }

        var slug = nav.data('id');
        var storageKey = greenmart_settings.storage_key + '_' + slug + '_' + layout;
        var storedData = false;
        var unparsedData = localStorage.getItem(storageKey);

        try {
          storedData = JSON.parse(unparsedData);
        } catch (e) {
          console.log('cant parse Json', e);
        }

        if (storedData) {
          nav.html(storedData);
          element.removeClass('load-ajax');
          $this.closest('.element-menu-ajax').removeClass('ajax-active');

          if (layout === 'treeview') {
            $(document.body).trigger('tbay_load_html_click_treeview');
          } else {
            $(document.body).trigger('tbay_load_html_click');
          }
        } else {
          $.ajax({
            url: greenmart_settings.ajaxurl,
            data: {
              action: 'greenmart_load_html_click',
              slug: slug,
              type_menu: type_menu,
              layout: layout,
              header_type: header_type
            },
            dataType: 'json',
            method: 'POST',
            beforeSend: function (xhr) {
              element.addClass('load-ajax');
            },
            success: function (response) {
              if (response.status === 'success') {
                nav.html(response.data);
                localStorage.setItem(storageKey, JSON.stringify(response.data));

                if (layout === 'treeview') {
                  $(document.body).trigger('tbay_load_html_click_treeview');
                } else {
                  $(document.body).trigger('tbay_load_html_click');
                }
              } else {
                console.log('loading html dropdowns returns wrong data - ', response.message);
              }

              element.removeClass('load-ajax');
              $this.closest('.element-menu-ajax').removeClass('ajax-active');
            },
            error: function () {
              console.log('loading html dropdowns ajax error');
            }
          });
        }
      });
    });
  }

}

class MenuCanvasDefaultClickAJAX {
  constructor() {
    if (typeof greenmart_settings === "undefined") return;

    this._initmenuCanvasDefaultClickAJAX();
  }

  _initmenuCanvasDefaultClickAJAX() {
    $('.menu-canvas-click').off('click').on('click', function (e) {
      e.preventDefault();
      var $this = $(this);
      if (!$this.hasClass('ajax-active')) return;
      var element = $('#' + $this.data('id')),
          layout = element.data('wrapper')['layout'],
          menu_id = element.data('wrapper')['menu_id'],
          nav = element.find('.tbay-offcanvas-body > nav'),
          slug = nav.data('id'),
          storageKey = greenmart_settings.storage_key + '_' + slug + '_' + layout,
          storedData = false,
          unparsedData = localStorage.getItem(storageKey);

      try {
        storedData = JSON.parse(unparsedData);
      } catch (e) {
        console.log('cant parse Json', e);
      }

      if (storedData) {
        nav.html(storedData);
        element.removeClass('load-ajax');
        $this.removeClass('ajax-active');

        if (layout === 'treeview') {
          $(document.body).trigger('tbay_load_html_click_treeview');
        } else {
          $(document.body).trigger('tbay_load_html_click');
        }
      } else {
        $.ajax({
          url: greenmart_settings.ajaxurl,
          data: {
            action: 'greenmart_load_html_canvas_click',
            slug: slug,
            layout: layout,
            menu_id: menu_id
          },
          dataType: 'json',
          method: 'POST',
          beforeSend: function (xhr) {
            element.addClass('load-ajax');
          },
          success: function (response) {
            if (response.status === 'success') {
              nav.html(response.data);
              localStorage.setItem(storageKey, JSON.stringify(response.data));

              if (layout === 'treeview') {
                $(document.body).trigger('tbay_load_html_click_treeview');
              } else {
                $(document.body).trigger('tbay_load_html_click');
              }
            } else {
              console.log('loading html dropdowns returns wrong data - ', response.message);
            }

            element.removeClass('load-ajax');
            $this.removeClass('ajax-active');
          },
          error: function () {
            console.log('loading html dropdowns ajax error');
          }
        });
      }
    });
  }

}

window.$ = window.jQuery;
jQuery(document).ready(() => {
  new MenuDropdownsAJAX(), new MenuClickAJAX(), new MenuCanvasDefaultClickAJAX(), new StickyHeader(), new Tabs(), new Accordion(), new Mobile(), new AccountMenu(), new BackToTop(), new CanvasMenu(), new FuncCommon(), new TreeView(), new NewsLetter(), new Preload(), new Search(), new Section();
});
setTimeout(function () {
  jQuery(document.body).on('tbay_load_html_click_treeview', () => {
    new TreeView();
  });
}, 2000);
jQuery(window).on('load', function () {
  var common = new FuncCommon();

  common._removeAnimateVisible();
});
jQuery(window).resize(() => {
  var common = new FuncCommon();

  common._fixSliderHome3();

  common._toCategoryFixed();

  common._intLoader();
});
