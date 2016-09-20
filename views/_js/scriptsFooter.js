


$('#user-register-btn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 1000);
});

// Mensagens do sistemas
$(document).ready(function () {
    //$(".alert").delay(400).addClass("in").fadeIn(9000).fadeOut(9000);
    $(".alertH").hide();
    $(".alertH").alert();
    $(".alertH").fadeTo(8500, 2000).slideUp(800, function () {
        $(".alertH").slideUp(800);
    });

    // Popup alerta
    $('#popoverOption').popover({trigger: "hover"});
});

// Faz com que o menu selecionado fique ativo =====>
var url = window.location;
// só funcionará se string no href corresponde com a localização
$('ul.nav a[href="' + url + '"]').parent().addClass('active');

// Também vai trabalhar para hrefs relativos e absolutos
$('ul.nav a').filter(function () {
    return this.href == url;
}).parent().addClass('active');

// Modal outros
$('.openBtn').click(function () {

    $('.modal-body').load('/render/62805', function (result) {
        $('#myModal').modal({show: true});
    });
});

// Mascara formulario cadastro de pessoal
$(document).ready(function () {

    $("#cpf").inputmask({
        mask: '999.999.999-99'
    });


    $('#rg').inputmask({
        mask: '9.999.999'
    });

    $('#cep').inputmask({
        mask: '99999-999'
    });

    $('#tel-casa').inputmask({
        mask: '(99) 9999-9999'
    });

    $('#tel-cel').inputmask({
        mask: '(99) 99999-9999'
    });

    $("#nasc, #ini-ativi, #fim-ativi").inputmask({
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


//Pagina agenda
$.fn.refreshMe = function(opts){

      var $this = this,
          defaults = {
            ms:1500,
            parentSelector:'.panel',
            started:function(){},
            completed:function(){}
          },
          settings = $.extend(defaults, opts);

      var par = this.parents(settings.parentSelector);
      var panelToRefresh = par.find('.refresh-container');
      var dataToRefresh = par.find('.refresh-data');

      var ms = settings.ms;
      var started = settings.started;		//function before timeout
      var completed = settings.completed;	//function after timeout

      $this.click(function(){
        $this.addClass("fa-spin");
        panelToRefresh.show();
        if (dataToRefresh) {
          started(dataToRefresh);
        }
        setTimeout(function(){
          if (dataToRefresh) {
              completed(dataToRefresh);
          }
          panelToRefresh.fadeOut(800);
          $this.removeClass("fa-spin");
        },ms);
        return false;
      })//click

}

$(document).ready(function(){
  $('#refresh1').refreshMe({
    started:function(ele){ele.html("Atualizando...")},
  	completed:function(ele){ele.html("O quadro foi atualizado...")}
  });
});

/* end function refreshMe */


// Agenda popup inserção
    $(function(){
        $("#from, #to").datetimepicker({
            language: 'pt-BR',
            showMeridian: 'day',
            todayHighlight: true,
            viewSelect: 'day',
            clearBtn: true,
            beforeShowMonth: true,
            weekStart: true,
            format: 'dd/mm/yyyy hh:ii',
            autoclose: true,
            todayBtn: true,
            minuteStep: 1,
            pickerPosition: 'bottom-left',
            minDate: new Date()
        });
        
    });