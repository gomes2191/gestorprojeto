// <---------------End Script----------------->

/* global pattern */
$('#user-register-btn').on('click', function () {
  var $this = $(this);
  $this.button('loading');
  setTimeout(function () {
    $this.button('reset');
  }, 1000);
});

// Modal outros
$('.openBtn').click(function () {
  $('.modal-body').load('/render/62805', function (result) {
    $('#myModal').modal({
      show: true
    });
  });
});

// Mascara de campos

// Mascara de CPF/CNPJ
function formatarCampo(campoTexto) {
  if (campoTexto.value.length <= 11) {
    campoTexto.value = mascaraCpf(campoTexto.value);
  } else {
    campoTexto.value = mascaraCnpj(campoTexto.value);
  }
}

function retirarFormatacao(campoTexto) {
  campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g, "");
}

function mascaraCpf(valor) {
  return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "$1.$2.$3-$4");
}

function mascaraCnpj(valor) {
  return valor.replace(
    /(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g,
    "$1.$2.$3/$4-$5"
  );
}
// End -->

$('.cnpj').mask('00.000.000/0000-00', {
  reverse: true
});

$(document).ready(function () {
  $('.cpf').mask('000.000.000-00', {
    reverse: true
  });

  $('.cep').mask('00000-000');
  $('.phone_cel').mask('(00) 00000-0000');
  $('.phone_tel').mask('(00) 0000-00000');
  $('.data').mask('00/00/0000');
  $('.hora').mask('00:00');

  $('.uf').mask('AA');
  $('.money').mask('000.000.000.000.000,00', {
    reverse: true
  });
  $('.number').mask('000000000000000');

  // Agenda mascara
  $('.dataHora').mask('00/00/0000 00:00');
}); //------------------> End mask


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
  var linkVerfy = function (href) {
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

  if ((linkVerfy("pay") > 1) || (linkVerfy("receive") > 1) ||
    (linkVerfy("checks") > 1) || (linkVerfy("patrimony") > 1)) {
    jQuery.datetimepicker.setLocale('pt-BR');
    console.log('Patrimonio');
    $(".date").datetimepicker({
      mask: true,
      format: 'd/m/Y',
      validateOnBlur: true,
      closeOnWithoutClick: true,
      value: true,
      timepicker: false,
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
  } else if (textbox.validity.patternMismatch) {
    textbox.setCustomValidity('Siga o padrão necessário. Ex: dd/mm/aaaa hh:mm');
  } else {
    textbox.setCustomValidity('');
  }
  return true;
}

$(function () {
  $('input').focus(function () {
    $(this).css({
      "background-color": "rgba(0, 188, 212, 0.09)"
    });
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
  /* $('.container-fluid').on('click', '#btn-save, #btn-dell', function () {
    $('.form-hidden, #group-btn-hidden, #group-btn-show, .row-button-hidden').fadeOut();
    $('.form-register').find('input, textarea').val('');
    $('#group-btn-new').fadeTo("slow", 1);
    $('legend span').text('');
    $('html, body').animate({
      scrollTop: 0
    }, 'slow');
  }); */



  /* //Modo edição ativo
  $('#tableData').on('click','.btn-edit-show', function(e) {
      e.preventDefault();
      $('#group-btn-new, #btn-show').fadeOut();
      $('#btn-save, #btn-edit-save').attr('onclick',"typeAction(objData={type:'update'})").html("<i class='fas fa-save fa-lg'></i> <span>SALVAR ALTERAÇÃO</span>");
      $('.form-register').attr('id',"editForm");
      $('.form-hidden, #group-btn-hidden, .row-button-hidden, #group-btn-form-new, #btn-form-new').fadeIn();
      $('#btn-save, #btn-edit-save').attr('id',"btn-edit-save");
      $('legend span').text(' - Editando registro');
      $('html, body').animate({scrollTop:0}, 'slow');
  }); */

  // Ação que oculta o formulário
  /*  $('#btn-hidden').click(function (e) {
     e.preventDefault();
     $('#group-btn-hidden').fadeOut('slow');
     $('.form-hidden').fadeOut();
     $('.notice-hidden').fadeOut();
     $('.row-button-hidden').fadeOut();
     $('#group-btn-show').fadeIn();
     $('#btn-show').fadeIn();
   }); */

  // Dispara o evento mostrar formulário ao clica no botao
  /* $('#btn-show').click(function (e) {
    e.preventDefault();
    $('#group-btn-show').fadeOut('slow');
    $('.form-hidden').fadeIn('slow');
    $('#group-btn-hidden').fadeIn('slow');
    $('.row-button-hidden').fadeIn('slow');
  }); */

  //Botao que volta para adicionar novo registro
  /* $('.container-fluid').on('click', '#btn-form-new', function (e) {
    e.preventDefault();
    // Limpa os campos
    $('.form-register').find('input, textarea').val('');
    $('#btn-edit-save').attr('id', "btn-save");
    // Insere o texto indicando o tipo de formulario
    $('legend span').text(' - Inserindo registro');
    $('#btn-save').attr('onclick', "typeAction(objData={type:'add'})").html("<i class='fas fa-save fa-lg'></i> <span>SALVAR</span>");
    $('.form-register').attr('id', "#addForm");
    // Mostra o botão para voltar para formulario de inserção.
    $('#group-btn-form-new').hide(200);
    $('#group-btn-hidden').show(200);
    $('html, body').animate({
      scrollTop: 0
    }, 'slow');
  }); */
});

// Limpeza de filtros de pesquisa
$(function () {
  $('#sortBy').mousedown(function () {
    $('#keywords').val('');
  });
  $('#keywords ').mousedown(function () {
    $('#sortBy').val('');
  });
});

// Volta para o topo
$('.top').click(function () {
  $('html, body').animate({
    scrollTop: 0
  }, 'slow');
  return false;
});

function evBut(e) {
  e.addEventListener("click", function (e) {
    e.preventDefault()
  });

  alert('Foi acionado o buttão');
  x = document.querySelectorAll("#teste, #teste");
}//End




