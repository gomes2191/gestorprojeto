
/* global pattern */
$('#user-register-btn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 1000);
});
// Mensagens do sistemas
$(function (){
    //$(".alert").delay(400).addClass("in").fadeIn(9000).fadeOut(9000);
    $(".alertH").hide();
    $(".alertH").alert();
    $(".alertH").fadeTo(3300, 3300).slideUp(200, function () {
    $(".alertH").slideUp(200);
    
});
    // Popup alerta
    $('#popoverOption').popover({trigger: "hover"});
});
// Modal outros
$('.openBtn').click(function () {
    $('.modal-body').load('/render/62805', function (result) {
        $('#myModal').modal({show: true});
    });
});
// Mascara formulario cadastro de pessoal
$(document).ready(function () {
    $(".cpf").inputmask({
        mask: '999.999.999-99'
    });
    $('.cep').inputmask({
        mask: '99999-999'
    });
    $(".tel-casa").inputmask({
        mask: '(99) 9999-9999'
    });
    $(".tel-cel").inputmask({
        mask: '(99) 99999-9999'
    });
    $(".nasc, .data,  #ini-ativi, #fim-ativi").inputmask({
        mask: '99/99/9999'
    });
    $("#dom-1, #dom-2, #seg-1, #seg-2, #ter-1, #ter-2, #qua-1, #qua-2, #qui-1, #qui-2, #sex-1, #sex-2, #sab-1, #sab-2").inputmask({
        mask: '99:99'
    });
    $('.uf').inputmask({
        mask: 'aa'
    });
    // Agenda mascara
    $('.from, .to').inputmask({
        mask: '99/99/9999 99:99'
    });
    
    $('.fromEd, .toEd').inputmask({
        mask: '99/99/9999 99:99'
    });
    
    //  Geral data mascara data
    $('.data').inputmask({
        mask: '99/99/9999'
    });
});
//------------------> End mask
// Formulario cadastro validação form validator
$.validate({
  modules : 'security, brazil', 
  onModulesLoaded : function() {
    var optionalConfig = {
      fontSize: '12pt',
      fontWeight: 'normal',
      padding: '3px',
      bad : 'Muito fraca',
      weak : 'Fraco',
      good : 'Forte',
      strong : 'Muito forte'
    };
    $('input[name="user_password"]').displayPasswordStrength(optionalConfig);
  }
});
// Agenda popup inserção
$(function () {
    if (window.location.href.indexOf("agenda") > 1) {
        $("#from, #to").datetimepicker({
            language: 'pt-BR',
            showMeridian: true,
            todayHighlight: true,
            viewSelect: 'day',
            clearBtn: true,
            beforeShowMonth: true,
            weekStart: true,
            format: 'dd/mm/yyyy HH:ii',
            autoclose: true,
            todayBtn: true,
            minuteStep: 1,
            pickerPosition: 'bottom-left'
        });
    }
    
    if (window.location.href.indexOf("finances-pay") > 1) {
        $("#pay_venc, #pay_date_pay").datetimepicker({
            language: 'pt-BR-D',
            showMeridian: true,
            todayHighlight: true,
            viewSelect: 'day',
            clearBtn: true,
            beforeShowMonth: true,
            weekStart: true,
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayBtn: true,
            minuteStep: 1,
            pickerPosition: 'bottom-left'
        });
    }
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
//$( function (){
//        
//        $('#form-agenda-ajax').submit(
//           function(e){
//               e.preventDefault();
//
//               if($('#deletar').val() == 'Processando...') {
//                   return (false);
//
//               }
//
//               $('#deletar').val('Processando...');
//
//               $.ajax({
//                   url: 'agenda-box',
//                   type: 'post',
//                   dataType: 'html',
//                   data: {'metodo': $('#metodo').val()}
//
//
//               }).done(function(data){
//
//                    alert(data);
//
//                   $('#deletar').val('Deletar');
//                   $('#metodo').val('');
//
//
//               });
//        });
//    } );
        
   
   
   
$(function () {
    $('input').focus(function () {
        $(this).css({"background-color": "rgba(0, 188, 212, 0.09)"});
    });
    $('input').blur(function () {
        $('input').css('background', '#ffffff');
    });
});
//Parametros para o formulario hibrido dois em um
$(function () {
    $('#group-btn-hide').hide();
    $('#group-btn-show').hide();
    $('#btn-new-show').click(function () {
        $('#group-btn-new').hide(500);
        $('.form-hide').show(500);
        $('#group-btn-hide').show(500);
        $('.row-button-hide').show(500);
        $('.notice-hide').show(200);
        $('.notice-hide span').text('MODO ADICIONAR NOVO REGISTRO ATIVO');
    });
    
    //Botao que oculta o fomulario
    $('#btn-hide').click(function () {
        $('#group-btn-hide').hide(500);
        $('.form-hide').hide(500);
        
        //$('#fees-btn-hide').hide();
        $('#group-btn-show').show();
        //$('#fees_id').val("");
        
    });
    
    //Botao que mostra o formulario
    $('#btn-show').click(function (e) {
        e.preventDefault();
        $('#group-btn-show').hide(200);
        $('.form-hide').show(200);
        $('#group-btn-hide').show(200);
    });
    
    //Botao que voltar para adicionar novo registro
    $('.btn-form-new').click(function (e) {
        e.preventDefault();
        $('#form-register').removeClass("edit");
        $("#form-register").removeAttr("data-id");
        // Insere o texto indicando o tipo de formulario
        $('.notice-hide span').text('MODO ADICIONAR NOVO REGISTRO ATIVO');
        
        // Mostra o botão para voltar para formulario de inserção.
        $('#group-btn-form-new').hide(200);
        $('#group-btn-hide').show(200);
        $('html, body').animate({scrollTop:0}, 'slow');
        
    });
});

// Limpeza de filtros de pesquisa
$(function (){
    $('#sortBy').mousedown( function (){
        $('#keywords').val(''); 
    });
    $('#keywords ').mousedown( function (){
        $('#sortBy').val('');
    });
    
});
