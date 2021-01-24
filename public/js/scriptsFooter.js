/*!
  * Bootstrap Toaster v0.0.1 (https://iqbalfn.github.io/bootstrap-toaster/)
  * Copyright 2019 Iqbal Fauzi
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
  */
 (function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports, require('jquery')) :
    typeof define === 'function' && define.amd ? define(['exports', 'jquery'], factory) :
    (global = global || self, factory(global['bootstrap-toaster'] = {}, global.jQuery));
  }(this, function (exports, $) { 'use strict';

    $ = $ && $.hasOwnProperty('default') ? $['default'] : $;

    function _defineProperties(target, props) {
      for (var i = 0; i < props.length; i++) {
        var descriptor = props[i];
        descriptor.enumerable = descriptor.enumerable || false;
        descriptor.configurable = true;
        if ("value" in descriptor) descriptor.writable = true;
        Object.defineProperty(target, descriptor.key, descriptor);
      }
    }

    function _createClass(Constructor, protoProps, staticProps) {
      if (protoProps) _defineProperties(Constructor.prototype, protoProps);
      if (staticProps) _defineProperties(Constructor, staticProps);
      return Constructor;
    }

    function _defineProperty(obj, key, value) {
      if (key in obj) {
        Object.defineProperty(obj, key, {
          value: value,
          enumerable: true,
          configurable: true,
          writable: true
        });
      } else {
        obj[key] = value;
      }

      return obj;
    }

    function _objectSpread(target) {
      for (var i = 1; i < arguments.length; i++) {
        var source = arguments[i] != null ? arguments[i] : {};
        var ownKeys = Object.keys(source);

        if (typeof Object.getOwnPropertySymbols === 'function') {
          ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) {
            return Object.getOwnPropertyDescriptor(source, sym).enumerable;
          }));
        }

        ownKeys.forEach(function (key) {
          _defineProperty(target, key, source[key]);
        });
      }

      return target;
    }

    /**
     * ------------------------------------------------------------------------
     * Constants
     * ------------------------------------------------------------------------
     */

    var NAME = 'toaster';
    var VERSION = '0.0.1';
    var Default = {
      title: false,
      content: '<em>No content</em>',
      delay: 3000,
      position: 'top right'
    };
    var DefaultTitle = {
      text: '',
      icon: null,
      image: null,
      close: true,
      info: false
    };
    var ToasterObject;
    var ToasterContainer = {};
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

    var Toaster =
    /*#__PURE__*/
    function () {
      function Toaster(opt, title) {
        if (null === opt) return;
        if (!ToasterObject) ToasterObject = new Toaster(null);

        ToasterObject._open(opt, title);
      } // Privates


      var _proto = Toaster.prototype;

      _proto._getContainer = function _getContainer(config) {
        var position = (config.position || 'top right').split(' ');
        var ver = position[0] || 'top';
        var hor = position[1] || 'right';
        if (!['top', 'bottom'].includes(ver)) ver = 'top';
        if (!['left', 'center', 'right'].includes(hor)) hor = 'right';
        position = ver + " " + hor;
        if (ToasterContainer[position]) return ToasterContainer[position];

        var html = this._makeContainer(ver, hor);

        ToasterContainer[position] = $(html).appendTo('body');
        return ToasterContainer[position];
      };

      _proto._makeBody = function _makeBody(config) {
        return "<div class=\"toast-body\">" + config.content + "</div>";
      };

      _proto._makeContainer = function _makeContainer(ver, hor) {
        var css = "position:fixed;width:320px;" + ver + ":20px;z-index:1060;";
        if (hor === 'center') css += 'left:50%;margin-left:-160px';else css += hor + ":20px";
        return "<div aria-live=\"polite\" aria-atomic=\"true\" style=\"" + css + "\"></div>";
      };

      _proto._makeHeader = function _makeHeader(config) {
        if (!config.title) return '';
        if (typeof config.title === 'string') config.title = {
          text: config.title
        };

        var title = _objectSpread({}, DefaultTitle, config.title);

        var eImage = '';
        if (title.image) eImage = "<img src=\"" + title.image + "\" class=\"rounded mr-2\" alt=\"#\">";else if (title.icon) eImage = "<i class=\"" + title.icon + " mr-2\"></i>";
        var eTitle = !title.text ? '' : "<strong class=\"mr-auto\">" + title.text + "</strong>";
        var eInfo = !title.info ? '' : "<small>" + title.info + "</small>";
        var eClose = !title.close ? '' : " <button type=\"button\" class=\"ml-2 mb-1 close\" data-dismiss=\"toast\" aria-label=\"Close\">\n                    <span aria-hidden=\"true\">&times;</span>\n                </button>";
        return "\n            <div class=\"toast-header\">\n                " + eImage + "\n                " + eTitle + "\n                " + eInfo + "\n                " + eClose + "\n            </div>\n        ";
      };

      _proto._makeHtml = function _makeHtml(config) {
        var header = this._makeHeader(config);

        var body = this._makeBody(config);

        return "\n            <div class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">\n                " + header + " " + body + "\n            </div>";
      };

      _proto._open = function _open(opt, title) {
        if (typeof opt !== 'object') {
          opt = {
            content: opt
          };
          if (undefined !== title) opt.title = title;
        }

        var config = _objectSpread({}, Default, opt);

        var html = this._makeHtml(config);

        $(html).appendTo(this._getContainer(config)).toast({
          animation: true,
          autohide: true,
          delay: config.delay
        }).toast('show').on('hidden.bs.toast', function () {
          $(this).remove();
        });
      } // Getters
      ;

      // Static
      Toaster.setDefault = function setDefault(opts) {
        for (var k in opts) {
          Default[k] = opts[k];
        }
      };

      _createClass(Toaster, null, [{
        key: "VERSION",
        get: function get() {
          return VERSION;
        }
      }, {
        key: "Default",
        get: function get() {
          return Default;
        }
      }]);

      return Toaster;
    }();
    /**
     * ------------------------------------------------------------------------
     * jQuery
     * ------------------------------------------------------------------------
     */


    $[NAME] = Toaster;

    exports.Toaster = Toaster;

    Object.defineProperty(exports, '__esModule', { value: true });

  }));
  //# sourceMappingURL=bootstrap-toaster.js.map

// <---------------End Script----------------->



/* global pattern */
$('#user-register-btn').on('click', function() {
  var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 1000);
});

// Modal outros
$('.openBtn').click(function () {
    $('.modal-body').load('/render/62805', function (result) {
        $('#myModal').modal({show: true});
    });
});

// Mascara de campos
$(document).ready(function () {
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cep').mask('00000-000');
    $('.phone_cel').mask('(00) 00000-0000');
    $('.phone_tel').mask('(00) 0000-00000');
    $('.data').mask('00/00/0000');
    $('.hora').mask('00:00');
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.uf').mask('AA');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.number').mask('000000000000000');

    // Agenda mascara
    $('.dataHora').mask('00/00/0000 00:00');
});//------------------> End mask


// Formulario cadastro validação form validator
//$.validate({
//  validateOnBlur : true, // disable validation when input looses focus
//  errorMessagePosition : 'top', // Instead of 'inline' which is default
//  scrollToTopOnError : false, // Set this property to true on longer forms
//  modules : 'security, brazil',
//  onModulesLoaded : function() {
//    var optionalConfig = {
//      fontSize: '12pt',
//      fontWeight: 'normal',
//      padding: '3px',
//      bad : 'Muito fraca',
//      weak : 'Fraco',
//      good : 'Forte',
//      strong : 'Muito forte'
//    };
//    $('input[name="user_password"]').displayPasswordStrength(optionalConfig);
//  }
//
//});

// Agenda popup inserção
//$(function () {
//    if (window.location.href.indexOf("agenda") > 1 ) {
//        $(".dataTime").datetimepicker({
//            inline: true,
//            locale: 'pt-br',
//            format: 'DD/MM/YYYY HH:MM',
//            showTodayButton: true,
//            showClear: true,
//            showClose: true,
//            disabledHours: false,
//            focusOnShow: true,
//            tooltips: {
//                today: 'Data de Hoje',
//                clear: 'Limpar Campo',
//                close: 'Fechar Calendário',
//                selectMonth: 'Select Month',
//                prevMonth: 'Previous Month',
//                nextMonth: 'Next Month',
//                selectYear: 'Select Year',
//                prevYear: 'Previous Year',
//                nextYear: 'Next Year',
//                selectDecade: 'Select Decade',
//                prevDecade: 'Previous Decade',
//                nextDecade: 'Next Decade',
//                prevCentury: 'Previous Century',
//                nextCentury: 'Next Century',
//                incrementHour: 'Increment Hour',
//                pickHour: 'Pick Hour',
//                decrementHour:'Decrement Hour',
//                incrementMinute: 'Increment Minute',
//                pickMinute: 'Pick Minute',
//                decrementMinute:'Decrement Minute',
//                incrementSecond: 'Increment Second',
//                pickSecond: 'Pick Second',
//                decrementSecond:'Decrement Second'
//            }
//
//        });
//    }

$(function () {
    var linkVerfy = function(href){
        return window.location.href.indexOf(href);
    };

    if (linkVerfy("agenda") > 1) {
        jQuery.datetimepicker.setLocale('pt-BR');
        $(".dateTime").datetimepicker({
            format: 'd/m/Y H:i',
            mask: '99/99/9999 99:99',
            validateOnBlur: true,
            closeOnWithoutClick: true,
            value: true,
            onShow: function (ct) {
                this.setOptions({
                    maxDate: jQuery('.dateTimeEnd').val() ? jQuery('.dateTimeEnd').val() : false
                });
            }
        });
        jQuery('.dateTimeEnd').datetimepicker({
            format: 'd/m/Y H:i',
            mask: '00/00/0000 00:00',
            value: false,
            onShow: function (ct) {
                this.setOptions({
                    minDate: jQuery('.dateTime').val() ? jQuery('.dateTime').val() : false
                });
            }

        });

    }

    if ( (linkVerfy("pay") > 1) || (linkVerfy("receive") > 1)
        || (linkVerfy("checks") > 1) || (linkVerfy("patrimony") > 1)) {
        jQuery.datetimepicker.setLocale('pt-BR');
        console.log('Patrimonio');
        $(".date").datetimepicker({
            mask:true,format:'d/m/Y',
            validateOnBlur:true,
            closeOnWithoutClick :true,
            value:true,
            timepicker:false,
            focusOnShow: true,
            showTodayButton: true,
        });
    }

//    if ( (linkVerfy("finances-pay") > 1) || (linkVerfy("finances-receive") > 1)
//         || (linkVerfy("finances-checks") > 1)  )  {
//        $(".data").datetimepicker({
//            locale: 'pt-br',
//            format: 'DD/MM/YYYY',
//            showTodayButton: true,
//            showClear: true,
//            showClose: true,
//            disabledHours: true,
//            focusOnShow: true,
//            tooltips: {
//                today: 'Data de Hoje',
//                clear: 'Limpar Campo',
//                close: 'Fechar Calendário',
//                selectMonth: 'Select Month',
//                prevMonth: 'Previous Month',
//                nextMonth: 'Next Month',
//                selectYear: 'Select Year',
//                prevYear: 'Previous Year',
//                nextYear: 'Next Year',
//                selectDecade: 'Select Decade',
//                prevDecade: 'Previous Decade',
//                nextDecade: 'Next Decade',
//                prevCentury: 'Previous Century',
//                nextCentury: 'Next Century',
//                incrementHour: 'Increment Hour',
//                pickHour: 'Pick Hour',
//                decrementHour:'Decrement Hour',
//                incrementMinute: 'Increment Minute',
//                pickMinute: 'Pick Minute',
//                decrementMinute:'Decrement Minute',
//                incrementSecond: 'Increment Second',
//                pickSecond: 'Pick Second',
//                decrementSecond:'Decrement Second'
//            }
//
//        });
//    }
});

// Validação dos campos data hora do evento modal de edição da agenda
function InvalidMsg(textbox) {
    if (textbox.value == '') {
        textbox.setCustomValidity('Este campo deve ser preenchido. Ex: dd/mm/aaaa hh:mm');
    }
    else if(textbox.validity.patternMismatch){
        textbox.setCustomValidity('Siga o padrão necessário. Ex: dd/mm/aaaa hh:mm');
    }
    else {
        textbox.setCustomValidity('');
    }
    return true;
}

$(function () {
    $('input').focus(function () {
        $(this).css({"background-color": "rgba(0, 188, 212, 0.09)"});
    });
    $('input').blur(function () {
        $('input').css('background', '#ffffff');
    });
});

//----Parametros para o formulario hibrido dois em um
$(function () {
    //Ativa modo de novo registro
   /*  $('.container-fluid').on('click', '#btn-new-show', function(e) {
        e.preventDefault();
        $('#group-btn-new, #group-btn-form-new').fadeOut();
        $('#btn-save, #btn-edit-save').attr('onclick',"typeAction(objData={type:'add'})").html("<i class='fas fa-save fa-lg'></i> <span>SALVAR</span>");
       // $('.form-register').attr('id',"addForm");
        $('.form-hidden, #group-btn-hidden, .row-button-hidden').fadeIn();
        $('.form-register').find('input, textarea').val('');
        $('legend span').text(' - Inserindo registro');
    });
 */
    //--> Rotina que limpa formulário apos edição e remoção de dados
    $('.container-fluid').on('click', '#btn-edit-save, #btn-dell', function (){
        $('.form-hidden, #group-btn-hidden, #group-btn-show, .row-button-hidden').fadeOut();
        $('.form-register').find('input, textarea').val('');
        $('#group-btn-new').fadeIn();
        $('legend span').text('');
        $('html, body').animate({scrollTop:0}, 'slow');
    });

    /* //Modo edição ativo
    $('#tableData').on('click','.btn-edit-show', function(e) {
        e.preventDefault();
        $('#group-btn-new, #btn-show').fadeOut();
        $('#btn-save, #btn-edit-save').attr('onclick',"typeAction(objData={type:'update'})").html("<i class='fas fa-save fa-lg'></i> <span>SALVAR ALTERAÇÃO</span>");
        $('.form-register').attr('id',"editForm");
        $('.form-hidden, #group-btn-hidden,  .row-button-hidden, #group-btn-form-new, #btn-form-new').fadeIn();
        $('#btn-save, #btn-edit-save').attr('id',"btn-edit-save");
        $('legend span').text(' - Editando registro');
        $('html, body').animate({scrollTop:0}, 'slow');
    }); */

    // Ação que oculta o formulário
    $('#btn-hidden').click(function(e) {
        e.preventDefault();
        $('#group-btn-hidden').fadeOut('slow');
        $('.form-hidden').fadeOut();
        $('.notice-hidden').fadeOut();
        $('.row-button-hidden').fadeOut();
        $('#group-btn-show').fadeIn();
        $('#btn-show').fadeIn();
    });

    // Dispara o evento mostrar formulário ao clica no botao
    $('#btn-show').click(function(e) {
        e.preventDefault();
        $('#group-btn-show').fadeOut('slow');
        $('.form-hidden').fadeIn('slow');
        $('#group-btn-hidden').fadeIn('slow');
        $('.row-button-hidden').fadeIn('slow');
    });

    //Botao que voltar para adicionar novo registro
    $('.container-fluid').on('click', '#btn-form-new', function(e) {
        e.preventDefault();
        // Limpa os campos
        $('.form-register').find('input, textarea').val('');
        $('#btn-edit-save').attr('id',"btn-save");
        // Insere o texto indicando o tipo de formulario
        $('legend span').text(' - Inserindo registro');
        $('#btn-save').attr('onclick',"typeAction(objData={type:'add'})").html("<i class='fas fa-save fa-lg'></i> <span>SALVAR</span>");
        $('.form-register').attr('id',"#addForm");
        // Mostra o botão para voltar para formulario de inserção.
        $('#group-btn-form-new').hide(200);
        $('#group-btn-hidden').show(200);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
});

// Limpeza de filtros de pesquisa
$(function(){
    $('#sortBy').mousedown( function (){
        $('#keywords').val('');
    });
    $('#keywords ').mousedown( function (){
        $('#sortBy').val('');
    });
});

// Volta para o topo
$('.top').click(function(){
    $('html, body').animate({scrollTop:0}, 'slow');
    return false;
});

function evBut(e){
  e.addEventListener("click", function(e){
    e.preventDefault()
  });

  alert('Foi acionado o buttão');
  x = document.querySelectorAll("#teste, #teste");
}

