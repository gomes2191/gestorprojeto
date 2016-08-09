
    // Alerta tela de cadastro empresa
    $(".alert").delay(200).addClass("in").fadeOut(9000);

    // Faz com que o menu selecionado fique ativo =====>
    var url = window.location;
    // só funcionará se string no href corresponde com a localização
    $('ul.nav a[href="' + url + '"]').parent().addClass('active');

    // Também vai trabalhar para hrefs relativos e absolutos
    $('ul.nav a').filter(function(){
        return this.href == url;
    }).parent().addClass('active');
    
    // Modal outros
    $('.openBtn').click(function(){
  
  	$('.modal-body').load('/render/62805',function(result){
	    $('#myModal').modal({show:true});
	});	
    });
    
    // Formulario cadastro de usuarios
    jQuery("#cpf").mask("999.999.999-99");
    
    jQuery("#rg").mask("9.999.999");
    
    jQuery("#nascimento").mask("99/99/9999");
    
    jQuery("#cep").mask("99999-999");
    
    jQuery("#tel").mask("(99) 9999-9999");
    
    jQuery("#cel").mask("(99) 99999-9999");
    
    jQuery("#hora").mask("99:99");
    
    