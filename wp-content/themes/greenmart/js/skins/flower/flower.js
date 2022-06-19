'use strict';

class Feature {
  constructor() {
    var _this = this;

    _this._searchHorizontal();

    _this._initFeature();

    _this._initMiniCartV2();

    _this._click_horizontal_search();

    _this._topMenu();

    _this._clickNotTopMenu();
  }

  _initFeature() {}

  _searchHorizontal() {
    jQuery(".search-horizontal .btn-search-totop").on("click", function () {
      jQuery(".container-search-horizontal").toggleClass('active');
    });
  }

  _initMiniCartV2() {
    jQuery(".mini-cart.v2").on("click", function (e) {
      jQuery('#wrapper-container').toggleClass('active-cart');
      jQuery('#wrapper-container').toggleClass(e.currentTarget.dataset.offcanvas);
      jQuery('.tbay-dropdown-cart').toggleClass('active');
    });
    var $win = jQuery(window);
    var $box = jQuery('.tbay-dropdown-cart .dropdown-content, .topbar-mobile .btn,#tbay-mobile-menu, .active-mobile button,#tbay-offcanvas-main,.topbar-mobile .btn-toggle-canvas,#tbay-offcanvas-main .btn-toggle-canvas');
    $win.on("click.Bst,click touchstart tap", function (event) {
      if ($box.has(event.target).length == 0 && !$box.is(event.target)) {
        jQuery('#wrapper-container').removeClass('active active-cart');
        jQuery('.tbay-dropdown-cart').removeClass('active');
        jQuery('#tbay-offcanvas-main,.tbay-offcanvas').removeClass('active');
        jQuery("#tbay-dropdown-cart").hide('500');
      }
    });
  }

  _fixhome3() {
    var mainwidth = jQuery('#tbay-main-content').width();
    var marginleft = (mainwidth - jQuery('#tbay-main-content>.container').width()) / 2;
    jQuery('.tb-full').css('width', mainwidth);
    jQuery('.tb-full').css('max-width', mainwidth);

    if (jQuery('body').hasClass("rtl")) {
      jQuery('.tb-full').css('margin-right', -marginleft + 15);
    } else {
      jQuery('.tb-full').css('margin-left', -marginleft + 15);
    }

    jQuery('.tb-full .vc_fluid').css('padding', 0);
  }

  _click_horizontal_search() {
    var $win_search = jQuery(window);
    var $box_search = jQuery('.search-horizontal .btn-search-totop, .container-search-horizontal,.ui-autocomplete.ui-widget-content.horizontal');
    $win_search.on("click.Bst", function (event) {
      if ($box_search.has(event.target).length == 0 && !$box_search.is(event.target)) {
        jQuery(".container-search-horizontal").removeClass('active');
      }
    });
  }

  _topMenu() {
    jQuery(".top-menu .dropdown .account-button").off().on("click", function () {
      jQuery(".top-menu .dropdown .account-menu").slideToggle(500, function () {});
    });
  }

  _clickNotTopMenu() {
    var $win_my_account = jQuery(window);
    var $box_my_account = jQuery('.top-menu .dropdown .account-menu, .top-menu .dropdown .account-button');
    $win_my_account.on("click.Bst", function (event) {
      if ($box_my_account.has(event.target).length == 0 && !$box_my_account.is(event.target)) {
        jQuery(".top-menu .dropdown .account-menu").slideUp(500, function () {});
      }
    });
  }

}

jQuery(document).ready(() => {
  new Feature();
});
var width = jQuery(window).width();

if (width >= 1600) {
  var feature = new Feature();

  feature._fixhome3();
}

jQuery(window).on('load', function () {
  var feature = new Feature();

  if (width >= 1600) {
    feature._fixhome3();
  }
});
jQuery(window).scroll(function () {
  if (jQuery(window).scrollTop() > 0) {
    if (jQuery('.header-v3').hasClass('fix')) return;
    jQuery('.header-v3').addClass('fix');
  } else {
    jQuery('.header-v3').removeClass('fix');
  }
});
jQuery(window).resize(function () {
  var feature = new Feature();

  feature._fixhome3();
});
