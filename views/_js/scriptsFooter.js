
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
  validateOnBlur : true, // disable validation when input looses focus
  errorMessagePosition : 'top', // Instead of 'inline' which is default
  scrollToTopOnError : false, // Set this property to true on longer forms
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
    if (window.location.href.indexOf("agenda") > 1 ) {
        $("#from, #to").datetimepicker({
            
        });
    }
    
    var linkVerfy = function(href){
        return window.location.href.indexOf(href);
    };
    
    if ( (linkVerfy("finances-pay") > 1) || (linkVerfy("finances-receive") > 1) 
         || (linkVerfy("finances-checks") > 1)  )  {
        $(".data").datetimepicker({
            locale: 'pt-br',
            format: 'DD/MM/YYYY',
            showTodayButton: true,
            showClear: true,
            showClose: true,
            disabledHours: false,
            focusOnShow: true,
            tooltips: {
                today: 'Data de Hoje',
                clear: 'Limpar Campo',
                close: 'Fechar Calendário',
                selectMonth: 'Select Month',
                prevMonth: 'Previous Month',
                nextMonth: 'Next Month',
                selectYear: 'Select Year',
                prevYear: 'Previous Year',
                nextYear: 'Next Year',
                selectDecade: 'Select Decade',
                prevDecade: 'Previous Decade',
                nextDecade: 'Next Decade',
                prevCentury: 'Previous Century',
                nextCentury: 'Next Century',
                incrementHour: 'Increment Hour',
                pickHour: 'Pick Hour',
                decrementHour:'Decrement Hour',
                incrementMinute: 'Increment Minute',
                pickMinute: 'Pick Minute',
                decrementMinute:'Decrement Minute',
                incrementSecond: 'Increment Second',
                pickSecond: 'Pick Second',
                decrementSecond:'Decrement Second'
            }

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

//----Parametros para o formulario hibrido dois em um
$(function () {
    //Ativa modo de novo registro
    $('#btn-new-show').click(function(e) {
        e.preventDefault();
        $('#group-btn-new').fadeOut('slow');
        $('#btn-save').attr('onclick',"userAction('add')").html("<i class='text-primary glyphicon glyphicon-plus'></i> <span class='text-primary'>ADICIONAR REGISTRO</span>");
        $('.form-register').attr('id',"addForm");
        $('.form-hide').fadeIn('slow');
        $('#group-btn-hide').fadeIn('slow');
        $('.row-button-hide').fadeIn('slow');
        $('.notice-hide').fadeIn();
        $('legend span').text(' - Modo Adicionar Novo Registro Ativo');
    });
    
    //Modo edição ativo
    $('#tableData').on('click','.btn-edit-show', function(e) {
        e.preventDefault();
        $('#group-btn-new').fadeOut('slow');
        $('#btn-show').fadeOut('slow');
        $('#group-btn-hide').fadeIn('slow');
        $('#btn-save').attr('onclick',"userAction('edit')").html("<i class='text-primary glyphicon glyphicon-refresh'></i> <span class='text-primary'>ATUALIZAR CONTA");
        $('.form-register').attr('id',"editForm");
        $('.form-hide').fadeIn('slow');
        $('#group-btn-form-new').fadeIn('slow');
        $('#btn-save').attr('id',"btn-edit-save");
        //$('#group-btn-hide').fadeIn('slow');
        $('.row-button-hide').fadeIn('slow');
        //$('.notice-hide').fadeIn();
        $('legend span').text(' - Modo Edição de Registro Ativo');
    });
    
    $('body').on('click', '#btn-edit-save', function(e){
        e.preventDefault();
        // Limpa os campos
        $('.form-register').find('input').val('');
        $('#btn-edit-save').attr('id',"btn-save");
        // Insere o texto indicando o tipo de formulario
        $('legend span').text(' - MODO ADICIONAR NOVO REGISTRO ATIVO');
        
        $('#btn-save').attr('onclick',"userAction('add')").html("<i class='text-primary glyphicon glyphicon-plus'></i> <span class='text-primary'>ADICIONAR REGISTRO</span>");
        $('.form-register').attr('id',"#addForm");
        // Mostra o botão para voltar para formulario de inserção.
        $('#group-btn-form-new').hide(200);
        $('#group-btn-hide').show(200);
        $('html, body').animate({scrollTop:0}, 'slow');
    });
    
    //Botao que oculta o fomulario
    $('#btn-hide').click(function(e) {
        e.preventDefault();
        $('#group-btn-hide').fadeOut('slow');
        $('.form-hide').fadeOut('slow');
        $('.notice-hide').fadeOut('slow');
        $('.row-button-hide').fadeOut('slow');
        $('#group-btn-show').fadeIn('slow');
        $('#btn-show').fadeIn('slow');
        
        
    });
    
    //Botao que mostra o formulario
    $('#btn-show').click(function(e) {
        e.preventDefault();
        $('#group-btn-show').fadeOut('slow');
        $('.form-hide').fadeIn('slow');
        $('#group-btn-hide').fadeIn('slow');
        $('.row-button-hide').fadeIn('slow');
    });
    
    //Botao que voltar para adicionar novo registro
    $('#btn-form-new').click(function(e) {
        e.preventDefault();
        // Limpa os campos
        $('.form-register').find('input').val('');
        $('#btn-edit-save').attr('id',"btn-save");
        // Insere o texto indicando o tipo de formulario
        $('legend span').text(' - MODO ADICIONAR NOVO REGISTRO ATIVO');
        
        $('#btn-save').attr('onclick',"userAction('add')").html("<i class='text-primary glyphicon glyphicon-plus'></i> <span class='text-primary'>ADICIONAR REGISTRO</span>");
        $('.form-register').attr('id',"#addForm");
        // Mostra o botão para voltar para formulario de inserção.
        $('#group-btn-form-new').hide(200);
        $('#group-btn-hide').show(200);
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


//Tooltip mensagem
$(function (){
   $('[data-toggle="tooltip"]').tooltip(); 
});