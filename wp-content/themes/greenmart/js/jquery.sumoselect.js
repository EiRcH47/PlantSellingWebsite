'use strict';

/*!
 * jquery.sumoselect - v3.0.2
 * http://hemantnegi.github.io/jquery.sumoselect
 * 2014-04-08
 *
 * Copyright 2015 Hemant Negi
 * Email : hemant.frnz@gmail.com
 * Compressor http://refresh-sf.com/
 */
(function ($) {

  $.fn.SumoSelect = function (options) {
    var settings = $.extend({
      placeholder: 'Select Here',
      csvDispCount: 3,
      captionFormat: '{0} Selected',
      captionFormatAllSelected: '{0} all selected!',
      floatWidth: 400,
      forceCustomRendering: false,
      nativeOnDevice: ['Android', 'BlackBerry', 'iPhone', 'iPad', 'iPod', 'Opera Mini', 'IEMobile', 'Silk'],
      outputAsCSV: false,
      csvSepChar: ',',
      okCancelInMulti: false,
      triggerChangeCombined: true,
      selectAll: false,
      search: false,
      searchText: 'Search...',
      noMatch: 'No matches for "{0}"',
      prefix: '',
      locale: ['OK', 'Cancel', 'Select All'],
      up: false
    }, options);
    var ret = this.each(function () {
      var selObj = this;
      if (this.sumo || !$(this).is('select')) return;
      this.sumo = {
        E: $(selObj),
        is_multi: $(selObj).attr('multiple'),
        select: '',
        caption: '',
        placeholder: '',
        optDiv: '',
        CaptionCont: '',
        ul: '',
        is_floating: false,
        is_opened: false,
        mob: false,
        Pstate: [],
        createElems: function () {
          var O = this;
          O.E.wrap('<div class="SumoSelect" tabindex="0">');
          O.select = O.E.parent();
          O.caption = $('<span>');
          O.CaptionCont = $('<p class="CaptionCont"><label><i></i></label></p>').addClass('SelectBox').attr('style', O.E.attr('style')).prepend(O.caption);
          O.select.append(O.CaptionCont);
          if (!O.is_multi) settings.okCancelInMulti = false;
          if (O.E.attr('disabled')) O.select.addClass('disabled').removeAttr('tabindex');

          if (settings.outputAsCSV && O.is_multi && O.E.attr('name')) {
            O.select.append($('<input class="HEMANT123" type="hidden" />').attr('name', O.E.attr('name')).val(O.getSelStr()));
            O.E.removeAttr('name');
          }

          if (O.isMobile() && !settings.forceCustomRendering) {
            O.setNativeMobile();
            return;
          }

          if (O.E.attr('name')) O.select.addClass('sumo_' + O.E.attr('name'));
          O.E.addClass('SumoUnder').attr('tabindex', '-1');
          O.optDiv = $('<div class="optWrapper ' + (settings.up ? 'up' : '') + '">');
          O.floatingList();
          O.ul = $('<ul class="options">');
          O.optDiv.append(O.ul);
          if (settings.selectAll) O.SelAll();
          if (settings.search) O.Search();
          O.ul.append(O.prepItems(O.E.children()));
          if (O.is_multi) O.multiSelelect();
          O.select.append(O.optDiv);
          O.basicEvents();
          O.selAllState();
        },
        prepItems: function (opts, d) {
          var lis = [],
              O = this;
          $(opts).each(function (i, opt) {
            opt = $(opt);
            lis.push(opt.is('optgroup') ? $('<li class="group ' + (opt[0].disabled ? 'disabled' : '') + '"><label>' + opt.attr('label') + '</label><ul></ul><li>').find('ul').append(O.prepItems(opt.children(), opt[0].disabled)).end() : O.createLi(opt, d));
          });
          return lis;
        },
        createLi: function (opt, d) {
          var O = this;
          if (!opt.attr('value')) opt.attr('value', opt.val());
          let li = $('<li class="opt"><label>' + opt.text() + '</label></li>');
          li.data('opt', opt);
          opt.data('li', li);
          if (O.is_multi) li.prepend('<span><i></i></span>');
          if (opt[0].disabled || d) li = li.addClass('disabled');
          O.onOptClick(li);
          if (opt[0].selected) li.addClass('selected');
          if (opt.attr('class')) li.addClass(opt.attr('class'));
          return li;
        },
        getSelStr: function () {
          sopt = [];
          this.E.find('option:selected').each(function () {
            sopt.push($(this).val());
          });
          return sopt.join(settings.csvSepChar);
        },
        multiSelelect: function () {
          var O = this;
          O.optDiv.addClass('multiple');
          O.okbtn = $('<p class="btnOk">' + settings.locale[0] + '</p>').on("click", function () {
            if (settings.triggerChangeCombined) {
              changed = false;

              if (O.E.find('option:selected').length != O.Pstate.length) {
                changed = true;
              } else {
                O.E.find('option').each(function (i, e) {
                  if (e.selected && O.Pstate.indexOf(i) < 0) changed = true;
                });
              }

              if (changed) {
                O.callChange();
                O.setText();
              }
            }

            O.hideOpts();
          });
          O.cancelBtn = $('<p class="btnCancel">' + settings.locale[1] + '</p>').on("click", function () {
            O._cnbtn();

            O.hideOpts();
          });
          O.optDiv.append($('<div class="MultiControls">').append(O.okbtn).append(O.cancelBtn));
        },
        _cnbtn: function () {
          var O = this;
          O.E.find('option:selected').each(function () {
            this.selected = false;
          });
          O.optDiv.find('li.selected').removeClass('selected');

          for (var i = 0; i < O.Pstate.length; i++) {
            O.E.find('option')[O.Pstate[i]].selected = true;
            O.ul.find('li.opt').eq(O.Pstate[i]).addClass('selected');
          }

          O.selAllState();
        },
        SelAll: function () {
          var O = this;
          if (!O.is_multi) return;
          O.selAll = $('<p class="select-all"><span><i></i></span><label>' + settings.locale[2] + '</label></p>');
          O.selAll.on('click', function () {
            O.selAll.toggleClass('selected');
            O.optDiv.find('li.opt').not('.hidden').each(function (ix, e) {
              e = $(e);

              if (O.selAll.hasClass('selected')) {
                if (!e.hasClass('selected')) e.trigger('click');
              } else if (e.hasClass('selected')) e.trigger('click');
            });
          });
          O.optDiv.prepend(O.selAll);
        },
        Search: function () {
          var O = this,
              cc = O.CaptionCont.addClass('search'),
              P = $('<p class="no-match">');
          O.ftxt = $('<input type="text" class="search-txt" value="" placeholder="' + settings.searchText + '">').on('click', function (e) {
            e.stopPropagation();
          });
          cc.append(O.ftxt);
          O.optDiv.children('ul').after(P);
          O.ftxt.on('keyup.sumo', function () {
            var hid = O.optDiv.find('ul.options li.opt').each(function (ix, e) {
              e = $(e);
              if (e.text().toLowerCase().indexOf(O.ftxt.val().toLowerCase()) > -1) e.removeClass('hidden');else e.addClass('hidden');
            }).not('.hidden');
            P.html(settings.noMatch.replace(/\{0\}/g, O.ftxt.val())).toggle(!hid.length);
            O.selAllState();
          });
        },
        selAllState: function () {
          var O = this;

          if (settings.selectAll) {
            var sc = 0,
                vc = 0;
            O.optDiv.find('li.opt').not('.hidden').each(function (ix, e) {
              if ($(e).hasClass('selected')) sc++;
              if (!$(e).hasClass('disabled')) vc++;
            });
            if (sc == vc) O.selAll.removeClass('partial').addClass('selected');else if (sc == 0) O.selAll.removeClass('selected partial');else O.selAll.addClass('partial');
          }
        },
        showOpts: function () {
          var O = this;
          if (O.E.attr('disabled')) return;
          O.is_opened = true;
          O.select.addClass('open');
          if (O.ftxt) O.ftxt.focus();else O.select.focus();
          $(document).on('click.sumo', function (e) {
            if (!O.select.is(e.target) && O.select.has(e.target).length === 0) {
              if (!O.is_opened) return;
              O.hideOpts();
              if (settings.okCancelInMulti) O._cnbtn();
            }
          });

          if (O.is_floating) {
            H = O.optDiv.children('ul').outerHeight() + 2;
            if (O.is_multi) H = H + parseInt(O.optDiv.css('padding-bottom'));
            O.optDiv.css('height', H);
            $('body').addClass('sumoStopScroll');
          }

          O.setPstate();
        },
        setPstate: function () {
          var O = this;

          if (O.is_multi && (O.is_floating || settings.okCancelInMulti)) {
            O.Pstate = [];
            O.E.find('option').each(function (i, e) {
              if (e.selected) O.Pstate.push(i);
            });
          }
        },
        callChange: function () {
          this.E.trigger('change').trigger('click');
        },
        hideOpts: function () {
          var O = this;

          if (O.is_opened) {
            O.is_opened = false;
            O.select.removeClass('open').find('ul li.sel').removeClass('sel');
            $(document).off('click.sumo');
            O.select.focus();
            $('body').removeClass('sumoStopScroll');

            if (settings.search) {
              O.ftxt.val('');
              O.optDiv.find('ul.options li').removeClass('hidden');
              O.optDiv.find('.no-match').toggle(false);
            }
          }
        },
        setOnOpen: function () {
          var O = this,
              li = O.optDiv.find('li.opt:not(.hidden)').eq(settings.search ? 0 : O.E[0].selectedIndex);
          O.optDiv.find('li.sel').removeClass('sel');
          li.addClass('sel');
          O.showOpts();
        },
        nav: function (up) {
          var O = this,
              c,
              s = O.ul.find('li.opt:not(.disabled, .hidden)'),
              sel = O.ul.find('li.opt.sel:not(.hidden)'),
              idx = s.index(sel);

          if (O.is_opened && sel.length) {
            if (up && idx > 0) c = s.eq(idx - 1);else if (!up && idx < s.length - 1 && idx > -1) c = s.eq(idx + 1);else return;
            sel.removeClass('sel');
            sel = c.addClass('sel');
            var ul = O.ul,
                st = ul.scrollTop(),
                t = sel.position().top + st;
            if (t >= st + ul.height() - sel.outerHeight()) ul.scrollTop(t - ul.height() + sel.outerHeight());
            if (t < st) ul.scrollTop(t);
          } else O.setOnOpen();
        },
        basicEvents: function () {
          var O = this;
          O.CaptionCont.on("click", function (evt) {
            O.E.trigger('click');
            if (O.is_opened) O.hideOpts();else O.showOpts();
            evt.stopPropagation();
          });
          O.select.on('keydown.sumo', function (e) {
            switch (e.which) {
              case 38:
                O.nav(true);
                break;

              case 40:
                O.nav(false);
                break;

              case 32:
                if (settings.search && O.ftxt.is(e.target)) return;

              case 13:
                if (O.is_opened) O.optDiv.find('ul li.sel').trigger('click');else O.setOnOpen();
                break;

              case 9:
              case 27:
                if (settings.okCancelInMulti) O._cnbtn();
                O.hideOpts();
                return;

              default:
                return;
            }

            e.preventDefault();
          });
          $(window).on('resize.sumo', function () {
            O.floatingList();
          });
        },
        onOptClick: function (li) {
          var O = this;
          li.on("click", function () {
            var li = $(this);
            if (li.hasClass('disabled')) return;

            if (O.is_multi) {
              li.toggleClass('selected');
              li.data('opt')[0].selected = li.hasClass('selected');
              O.selAllState();
            } else {
              li.parent().find('li.selected').removeClass('selected');
              li.toggleClass('selected');
              li.data('opt')[0].selected = true;
            }

            if (!(O.is_multi && settings.triggerChangeCombined && (O.is_floating || settings.okCancelInMulti))) {
              O.setText();
              O.callChange();
            }

            if (!O.is_multi) O.hideOpts();
          });
        },
        setText: function () {
          var O = this;
          O.placeholder = "";

          if (O.is_multi) {
            sels = O.E.find(':selected').not(':disabled');

            for (i = 0; i < sels.length; i++) {
              if (i + 1 >= settings.csvDispCount && settings.csvDispCount) {
                if (sels.length == O.E.find('option').length && settings.captionFormatAllSelected) {
                  O.placeholder = settings.captionFormatAllSelected.replace(/\{0\}/g, sels.length) + ',';
                } else {
                  O.placeholder = settings.captionFormat.replace(/\{0\}/g, sels.length) + ',';
                }

                break;
              } else O.placeholder += $(sels[i]).text() + ", ";
            }

            O.placeholder = O.placeholder.replace(/,([^,]*)$/, '$1');
          } else {
            O.placeholder = O.E.find(':selected').not(':disabled').text();
          }

          let is_placeholder = false;

          if (!O.placeholder) {
            is_placeholder = true;
            O.placeholder = O.E.attr('placeholder');
            if (!O.placeholder) O.placeholder = O.E.find('option:disabled:selected').text();
          }

          O.placeholder = O.placeholder ? settings.prefix + ' ' + O.placeholder : settings.placeholder;
          O.caption.html(O.placeholder);
          O.CaptionCont.attr('title', O.placeholder);
          let csvField = O.select.find('input.HEMANT123');
          if (csvField.length) csvField.val(O.getSelStr());
          if (is_placeholder) O.caption.addClass('placeholder');else O.caption.removeClass('placeholder');
          return O.placeholder;
        },
        isMobile: function () {
          var ua = navigator.userAgent || navigator.vendor || window.opera;

          for (var i = 0; i < settings.nativeOnDevice.length; i++) if (ua.toString().toLowerCase().indexOf(settings.nativeOnDevice[i].toLowerCase()) > 0) return settings.nativeOnDevice[i];

          return false;
        },
        setNativeMobile: function () {
          var O = this;
          O.E.addClass('SelectClass');
          O.mob = true;
          O.E.change(function () {
            O.setText();
          });
        },
        floatingList: function () {
          var O = this;
          O.is_floating = $(window).width() <= settings.floatWidth;
          O.optDiv.toggleClass('isFloating', O.is_floating);
          if (!O.is_floating) O.optDiv.css('height', '');
          O.optDiv.toggleClass('okCancelInMulti', settings.okCancelInMulti && !O.is_floating);
        },
        vRange: function (i) {
          var O = this;
          opts = O.E.find('option');
          if (opts.length <= i || i < 0) throw "index out of bounds";
          return O;
        },
        toggSel: function (c, i) {
          var O = this;

          if (typeof i === "number") {
            O.vRange(i);
            opt = O.E.find('option')[i];
          } else {
            opt = O.E.find('option[value="' + i + '"]')[0] || 0;
          }

          if (!opt || opt.disabled) return;

          if (opt.selected != c) {
            opt.selected = c;
            if (!O.mob) $(opt).data('li').toggleClass('selected', c);
            O.callChange();
            O.setPstate();
            O.setText();
            O.selAllState();
          }
        },
        toggDis: function (c, i) {
          var O = this.vRange(i);
          O.E.find('option')[i].disabled = c;
          if (c) O.E.find('option')[i].selected = false;
          if (!O.mob) O.optDiv.find('ul.options li').eq(i).toggleClass('disabled', c).removeClass('selected');
          O.setText();
        },
        toggSumo: function (val) {
          var O = this;
          O.enabled = val;
          O.select.toggleClass('disabled', val);

          if (val) {
            O.E.attr('disabled', 'disabled');
            O.select.removeAttr('tabindex');
          } else {
            O.E.removeAttr('disabled');
            O.select.attr('tabindex', '0');
          }

          return O;
        },
        toggSelAll: function (c) {
          var O = this;
          O.E.find('option').each(function (ix, el) {
            if (O.E.find('option')[$(this).index()].disabled) return;
            O.E.find('option')[$(this).index()].selected = c;
            if (!O.mob) O.optDiv.find('ul.options li').eq($(this).index()).toggleClass('selected', c);
            O.setText();
          });
          if (!O.mob && O.selAll) O.selAll.removeClass('partial').toggleClass('selected', c);
          O.callChange();
          O.setPstate();
        },
        reload: function () {
          var elm = this.unload();
          return $(elm).SumoSelect(settings);
        },
        unload: function () {
          var O = this;
          O.select.before(O.E);
          O.E.show();

          if (settings.outputAsCSV && O.is_multi && O.select.find('input.HEMANT123').length) {
            O.E.attr('name', O.select.find('input.HEMANT123').attr('name'));
          }

          O.select.remove();
          delete selObj.sumo;
          return selObj;
        },
        add: function (val, txt, i) {
          if (typeof val == "undefined") throw "No value to add";
          var O = this;
          opts = O.E.find('option');

          if (typeof txt == "number") {
            i = txt;
            txt = val;
          }

          if (typeof txt == "undefined") {
            txt = val;
          }

          opt = $("<option></option>").val(val).html(txt);
          if (opts.length < i) throw "index out of bounds";

          if (typeof i == "undefined" || opts.length == i) {
            O.E.append(opt);
            if (!O.mob) O.ul.append(O.createLi(opt));
          } else {
            opts.eq(i).before(opt);
            if (!O.mob) O.ul.find('li.opt').eq(i).before(O.createLi(opt));
          }

          return selObj;
        },
        remove: function (i) {
          var O = this.vRange(i);
          O.E.find('option').eq(i).remove();
          if (!O.mob) O.optDiv.find('ul.options li').eq(i).remove();
          O.setText();
        },
        selectItem: function (i) {
          this.toggSel(true, i);
        },
        unSelectItem: function (i) {
          this.toggSel(false, i);
        },
        selectAll: function () {
          this.toggSelAll(true);
        },
        unSelectAll: function () {
          this.toggSelAll(false);
        },
        disableItem: function (i) {
          this.toggDis(true, i);
        },
        enableItem: function (i) {
          this.toggDis(false, i);
        },
        enabled: true,
        enable: function () {
          return this.toggSumo(false);
        },
        disable: function () {
          return this.toggSumo(true);
        },
        init: function () {
          var O = this;
          O.createElems();
          O.setText();
          return O;
        }
      };
      selObj.sumo.init();
    });
    return ret.length == 1 ? ret[0] : ret;
  };
})(jQuery);

class SumoSelect {
  constructor() {
    this._initSumoSelect();
  }

  _initSumoSelect() {
    jQuery('.dropdown_product_cat').SumoSelect({
      csvDispCount: 3,
      captionFormatAllSelected: "Yeah, OK, so everything."
    });
    jQuery('.woocommerce-currency-switcher,.woocommerce-fillter >.select, .woocommerce-ordering > .orderby').SumoSelect({
      csvDispCount: 3,
      captionFormatAllSelected: "Yeah, OK, so everything."
    });
  }

}

jQuery(document).ready(function () {
  new SumoSelect();
});
