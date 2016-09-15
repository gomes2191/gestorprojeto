


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
    $(".alert").hide();
    $(".alert").alert();
    $(".alert").fadeTo(8500, 2000).slideUp(800, function () {
        $(".alert").slideUp(800);
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
     
     
     //Teste de ajax
     
      // Paginação
      $.fn.pageMe = function(opts){
        var $this = this,
        defaults = {
            perPage: 7,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);
    
    var listElement = $this;
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
      pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
     
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};

$(document).ready(function(){
    
  $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:4});
    
});