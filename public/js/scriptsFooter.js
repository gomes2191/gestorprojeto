
/*
 * Toastr
 * Copyright 2012-2015
 * Authors: John Papa, Hans Fjällemark, and Tim Ferrell.
 * All Rights Reserved.
 * Use, reproduction, distribution, and modification of this code is subject to the terms and
 * conditions of the MIT license, available at http://www.opensource.org/licenses/mit-license.php
 *
 * ARIA Support: Greta Krafsig
 *
 * Project: https://github.com/CodeSeven/toastr
 */
/* global define */
(function (define) {
    define(['jquery'], function ($) {
        return (function () {
            var $container;
            var listener;
            var toastId = 0;
            var toastType = {
                error: 'error',
                info: 'info',
                success: 'success',
                warning: 'warning'
            };

            var toastr = {
                clear: clear,
                remove: remove,
                error: error,
                getContainer: getContainer,
                info: info,
                options: {},
                subscribe: subscribe,
                success: success,
                version: '2.1.3',
                warning: warning
            };

            var previousToast;

            return toastr;

            ////////////////

            function error(message, title, optionsOverride) {
                return notify({
                    type: toastType.error,
                    iconClass: getOptions().iconClasses.error,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function getContainer(options, create) {
                if (!options) { options = getOptions(); }
                $container = $('#' + options.containerId);
                if ($container.length) {
                    return $container;
                }
                if (create) {
                    $container = createContainer(options);
                }
                return $container;
            }

            function info(message, title, optionsOverride) {
                return notify({
                    type: toastType.info,
                    iconClass: getOptions().iconClasses.info,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function subscribe(callback) {
                listener = callback;
            }

            function success(message, title, optionsOverride) {
                return notify({
                    type: toastType.success,
                    iconClass: getOptions().iconClasses.success,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function warning(message, title, optionsOverride) {
                return notify({
                    type: toastType.warning,
                    iconClass: getOptions().iconClasses.warning,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function clear($toastElement, clearOptions) {
                var options = getOptions();
                if (!$container) { getContainer(options); }
                if (!clearToast($toastElement, options, clearOptions)) {
                    clearContainer(options);
                }
            }

            function remove($toastElement) {
                var options = getOptions();
                if (!$container) { getContainer(options); }
                if ($toastElement && $(':focus', $toastElement).length === 0) {
                    removeToast($toastElement);
                    return;
                }
                if ($container.children().length) {
                    $container.remove();
                }
            }

            // internal functions

            function clearContainer (options) {
                var toastsToClear = $container.children();
                for (var i = toastsToClear.length - 1; i >= 0; i--) {
                    clearToast($(toastsToClear[i]), options);
                }
            }

            function clearToast ($toastElement, options, clearOptions) {
                var force = clearOptions && clearOptions.force ? clearOptions.force : false;
                if ($toastElement && (force || $(':focus', $toastElement).length === 0)) {
                    $toastElement[options.hiddenMethod]({
                        duration: options.hiddenDuration,
                        easing: options.hiddenEasing,
                        complete: function () { removeToast($toastElement); }
                    });
                    return true;
                }
                return false;
            }

            function createContainer(options) {
                $container = $('<div/>')
                    .attr('id', options.containerId)
                    .addClass(options.positionClass);

                $container.appendTo($(options.target));
                return $container;
            }

            function getDefaults() {
                return {
                    tapToDismiss: true,
                    toastClass: 'toast',
                    containerId: 'toast-container',
                    debug: false,

                    showMethod: 'fadeIn', //fadeIn, slideDown, and show are built into jQuery
                    showDuration: 300,
                    showEasing: 'swing', //swing and linear are built into jQuery
                    onShown: undefined,
                    hiddenMethod: 'fadeOut',
                    hiddenDuration: 1000,
                    hiddenEasing: 'swing',
                    onHidden: undefined,
                    closeMethod: false,
                    closeDuration: false,
                    closeEasing: false,
                    closeOnHover: true,

                    extendedTimeOut: 1000,
                    iconClasses: {
                        error: 'toast-error',
                        info: 'toast-info',
                        success: 'toast-success',
                        warning: 'toast-warning'
                    },
                    iconClass: 'toast-info',
                    positionClass: 'toast-top-right',
                    timeOut: 5000, // Set timeOut and extendedTimeOut to 0 to make it sticky
                    titleClass: 'toast-title',
                    messageClass: 'toast-message',
                    escapeHtml: false,
                    target: 'body',
                    closeHtml: '<button type="button">&times;</button>',
                    closeClass: 'toast-close-button',
                    newestOnTop: true,
                    preventDuplicates: false,
                    progressBar: false,
                    progressClass: 'toast-progress',
                    rtl: false
                };
            }

            function publish(args) {
                if (!listener) { return; }
                listener(args);
            }

            function notify(map) {
                var options = getOptions();
                var iconClass = map.iconClass || options.iconClass;

                if (typeof (map.optionsOverride) !== 'undefined') {
                    options = $.extend(options, map.optionsOverride);
                    iconClass = map.optionsOverride.iconClass || iconClass;
                }

                if (shouldExit(options, map)) { return; }

                toastId++;

                $container = getContainer(options, true);

                var intervalId = null;
                var $toastElement = $('<div/>');
                var $titleElement = $('<div/>');
                var $messageElement = $('<div/>');
                var $progressElement = $('<div/>');
                var $closeElement = $(options.closeHtml);
                var progressBar = {
                    intervalId: null,
                    hiddenEta: null,
                    maxHideTime: null
                };
                var response = {
                    toastId: toastId,
                    state: 'visible',
                    startTime: new Date(),
                    options: options,
                    map: map
                };

                personalizeToast();

                displayToast();

                handleEvents();

                publish(response);

                if (options.debug && console) {
                    console.log(response);
                }

                return $toastElement;

                function escapeHtml(source) {
                    if (source == null) {
                        source = '';
                    }

                    return source
                        .replace(/&/g, '&amp;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#39;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;');
                }

                function personalizeToast() {
                    setIcon();
                    setTitle();
                    setMessage();
                    setCloseButton();
                    setProgressBar();
                    setRTL();
                    setSequence();
                    setAria();
                }

                function setAria() {
                    var ariaValue = '';
                    switch (map.iconClass) {
                        case 'toast-success':
                        case 'toast-info':
                            ariaValue =  'polite';
                            break;
                        default:
                            ariaValue = 'assertive';
                    }
                    $toastElement.attr('aria-live', ariaValue);
                }

                function handleEvents() {
                    if (options.closeOnHover) {
                        $toastElement.hover(stickAround, delayedHideToast);
                    }

                    if (!options.onclick && options.tapToDismiss) {
                        $toastElement.click(hiddenToast);
                    }

                    if (options.closeButton && $closeElement) {
                        $closeElement.click(function (event) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (event.cancelBubble !== undefined && event.cancelBubble !== true) {
                                event.cancelBubble = true;
                            }

                            if (options.onCloseClick) {
                                options.onCloseClick(event);
                            }

                            hiddenToast(true);
                        });
                    }

                    if (options.onclick) {
                        $toastElement.click(function (event) {
                            options.onclick(event);
                            hiddenToast();
                        });
                    }
                }

                function displayToast() {
                    $toastElement.hide();

                    $toastElement[options.showMethod](
                        {duration: options.showDuration, easing: options.showEasing, complete: options.onShown}
                    );

                    if (options.timeOut > 0) {
                        intervalId = setTimeout(hiddenToast, options.timeOut);
                        progressBar.maxHideTime = parseFloat(options.timeOut);
                        progressBar.hiddenEta = new Date().getTime() + progressBar.maxHideTime;
                        if (options.progressBar) {
                            progressBar.intervalId = setInterval(updateProgress, 10);
                        }
                    }
                }

                function setIcon() {
                    if (map.iconClass) {
                        $toastElement.addClass(options.toastClass).addClass(iconClass);
                    }
                }

                function setSequence() {
                    if (options.newestOnTop) {
                        $container.prepend($toastElement);
                    } else {
                        $container.append($toastElement);
                    }
                }

                function setTitle() {
                    if (map.title) {
                        var suffix = map.title;
                        if (options.escapeHtml) {
                            suffix = escapeHtml(map.title);
                        }
                        $titleElement.append(suffix).addClass(options.titleClass);
                        $toastElement.append($titleElement);
                    }
                }

                function setMessage() {
                    if (map.message) {
                        var suffix = map.message;
                        if (options.escapeHtml) {
                            suffix = escapeHtml(map.message);
                        }
                        $messageElement.append(suffix).addClass(options.messageClass);
                        $toastElement.append($messageElement);
                    }
                }

                function setCloseButton() {
                    if (options.closeButton) {
                        $closeElement.addClass(options.closeClass).attr('role', 'button');
                        $toastElement.prepend($closeElement);
                    }
                }

                function setProgressBar() {
                    if (options.progressBar) {
                        $progressElement.addClass(options.progressClass);
                        $toastElement.prepend($progressElement);
                    }
                }

                function setRTL() {
                    if (options.rtl) {
                        $toastElement.addClass('rtl');
                    }
                }

                function shouldExit(options, map) {
                    if (options.preventDuplicates) {
                        if (map.message === previousToast) {
                            return true;
                        } else {
                            previousToast = map.message;
                        }
                    }
                    return false;
                }

                function hiddenToast(override) {
                    var method = override && options.closeMethod !== false ? options.closeMethod : options.hiddenMethod;
                    var duration = override && options.closeDuration !== false ?
                        options.closeDuration : options.hiddenDuration;
                    var easing = override && options.closeEasing !== false ? options.closeEasing : options.hiddenEasing;
                    if ($(':focus', $toastElement).length && !override) {
                        return;
                    }
                    clearTimeout(progressBar.intervalId);
                    return $toastElement[method]({
                        duration: duration,
                        easing: easing,
                        complete: function () {
                            removeToast($toastElement);
                            clearTimeout(intervalId);
                            if (options.onHidden && response.state !== 'hidden') {
                                options.onHidden();
                            }
                            response.state = 'hidden';
                            response.endTime = new Date();
                            publish(response);
                        }
                    });
                }

                function delayedHideToast() {
                    if (options.timeOut > 0 || options.extendedTimeOut > 0) {
                        intervalId = setTimeout(hiddenToast, options.extendedTimeOut);
                        progressBar.maxHideTime = parseFloat(options.extendedTimeOut);
                        progressBar.hiddenEta = new Date().getTime() + progressBar.maxHideTime;
                    }
                }

                function stickAround() {
                    clearTimeout(intervalId);
                    progressBar.hiddenEta = 0;
                    $toastElement.stop(true, true)[options.showMethod](
                        {duration: options.showDuration, easing: options.showEasing}
                    );
                }

                function updateProgress() {
                    var percentage = ((progressBar.hiddenEta - (new Date().getTime())) / progressBar.maxHideTime) * 100;
                    $progressElement.width(percentage + '%');
                }
            }

            function getOptions() {
                return $.extend({}, getDefaults(), toastr.options);
            }

            function removeToast($toastElement) {
                if (!$container) { $container = getContainer(); }
                if ($toastElement.is(':visible')) {
                    return;
                }
                $toastElement.remove();
                $toastElement = null;
                if ($container.children().length === 0) {
                    $container.remove();
                    previousToast = undefined;
                }
            }

        })();
    });
}(typeof define === 'function' && define.amd ? define : function (deps, factory) {
    if (typeof module !== 'undefined' && module.exports) { //Node
        module.exports = factory(require('jquery'));
    } else {
        window.toastr = factory(window.jQuery);
    }
})); //End script

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
        || (linkVerfy("checks") > 1) ) {
        jQuery.datetimepicker.setLocale('pt-BR');
        $(".date").datetimepicker({            
            mask:true,format:'d/m/Y',
            validateOnBlur:true,
            closeOnWithoutClick :true,
            value:true,
            timepicker:false
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
    $(' .container ').on('click', '#btn-new-show', function(e) {
        e.preventDefault();
        $('#group-btn-new, #group-btn-form-new ').fadeOut();
        $('#btn-save, #btn-edit-save').attr('onclick',"typeAction(objData={type:'add'})").html("<i class='fas fa-save fa-lg'></i> <span>SALVAR</span>");
        $('.form-register').attr('id',"addForm");
        $('.form-hidden, #group-btn-hidden, .row-button-hidden, .notice-hidden ').fadeIn();
        $('.form-register').find('input, textarea').val('');
        $('legend span').text(' - Inserindo registro');
    });
    
    //--> Rotina que limpa formulário apos edição e remoção de dados
    $('.container').on('click', '#btn-edit-save, #btn-dell', function (){
        $('.form-hidden, #group-btn-hidden, #group-btn-show, .row-button-hidden, .notice-hidden ').fadeOut();
        $('.form-register').find('input, textarea').val('');
        $('#group-btn-new').fadeIn();
        $('legend span').text('');
        $('html, body').animate({scrollTop:0}, 'slow');
    });
    
    //Modo edição ativo
    $('#tableData').on('click','.btn-edit-show', function(e) {
        e.preventDefault();
        $('#group-btn-new, #btn-show').fadeOut();
        $('#btn-save, #btn-edit-save').attr('onclick',"typeAction(objData={type:'update'})").html("<i class='fas fa-save fa-lg'></i> <span>SALVAR ALTERAÇÃO</span>");
        $('.form-register').attr('id',"editForm");
        $('.form-hidden, #group-btn-hidden, #group-btn-form-new, .row-button-hidden ').fadeIn();
        $('#btn-save, #btn-edit-save').attr('id',"btn-edit-save");
        $('legend span').text(' - Editando registro');
        $('html, body').animate({scrollTop:0}, 'slow');
    });
    
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
    $('.container').on('click', '#btn-form-new', function(e) {
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

