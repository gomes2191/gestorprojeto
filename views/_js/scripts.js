
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
    
    // Formulario cadastro de usuarios maskara
    jQuery("#cpf").mask("999.999.999-99");
    
    jQuery("#rg").mask("9.999.999");
    
    jQuery("#nascimento").mask("99/99/9999");
    
    jQuery("#cep").mask("99999-999");
    
    jQuery("#tel").mask("(99) 9999-9999");
    
    jQuery("#cel").mask("(99) 99999-9999");
    
    jQuery("#hora").mask("99:99");
    
    //Validando campos
    $.fn.goValidate = function() {
    var $form = this,
        $inputs = $form.find('input:text, input:password');
  
    var validators = {
        name: {
            regex: /^[A-Za-z]{3,}$/
        },
        
        clinic: {
            regex: /^([A-Z]{1}[a-z\s]{2,40})+$/
        },
        pass: {
            regex: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/
        },
        email: {
            regex: /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
        },
        phone: {
            regex: /^[2-9]\d{2}-\d{3}-\d{4}$/,
        }
    };
    var validate = function(klass, value) {
        var isValid = true,
            error = '';
            
        if (!value && /required/.test(klass)) {
            error = 'This field is required';
            isValid = false;
        } else {
            klass = klass.split(/\s/);
            $.each(klass, function(i, k){
                if (validators[k]) {
                    if (value && !validators[k].regex.test(value)) {
                        isValid = false;
                        error = validators[k].error;
                    }
                }
            });
        }
        return {
            isValid: isValid,
            error: error
        }
    };
    var showError = function($input) {
        var klass = $input.attr('class'),
            value = $input.val(),
            test = validate(klass, value);
      
        $input.removeClass('invalid');
        $('#form-error').addClass('hide');
        
        if (!test.isValid) {
            $input.addClass('invalid');
            
            if(typeof $input.data("shown") == "undefined" || $input.data("shown") == false){
               $input.popover('show');
            }
            
        }
      else {
        $input.popover('hide');
      }
    };
   
    $inputs.keyup(function() {
        showError($(this));
    });
  
    $inputs.on('shown.bs.popover', function () {
  		$(this).data("shown",true);
	});
  
    $inputs.on('hidden.bs.popover', function () {
  		$(this).data("shown",false);
	});
  
    $form.submit(function(e) {
      
        $inputs.each(function() { /* test each input */
        	if ($(this).is('.required') || $(this).hasClass('invalid')) {
            	showError($(this));
        	}
    	});
        if ($form.find('input.invalid').length) { /* form is not valid */
        	e.preventDefault();
            $('#form-error').toggleClass('hide');
        }
    });
    return this;
};

$('form').goValidate();





$.validate({
    modules : 'html5'
  });
    
    