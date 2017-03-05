
// Agenda paginador de eventos 
$(function () {
    var paginador;
    var totalPaginas;
    var itemsPorPagina = 3;
    var numerosPorPagina = 3;

    function creaPaginador(totalItems)
    {
        paginador = $(".pagination");

        totalPaginas = Math.ceil(totalItems / itemsPorPagina);

        $('<li><a href="#" class="first_link"><</a></li>').appendTo(paginador);
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(paginador);

        var pag = 0;
        while (totalPaginas > pag)
        {
            $('<li><a href="#" class="page_link">' + (pag + 1) + '</a></li>').appendTo(paginador);
            pag++;
        }


        if (numerosPorPagina > 1)
        {
            $(".page_link").hide();
            $(".page_link").slice(0, numerosPorPagina).show();
        }

        $('<li><a href="#" class="next_link">»</a></li>').appendTo(paginador);
        $('<li><a href="#" class="last_link">></a></li>').appendTo(paginador);

        paginador.find(".page_link:first").addClass("active");
        paginador.find(".page_link:first").parents("li").addClass("active");

        paginador.find(".prev_link").hide();

        paginador.find("li .page_link").click(function ()
        {
            var irpagina = $(this).html().valueOf() - 1;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .first_link").click(function ()
        {
            var irpagina = 0;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .prev_link").click(function ()
        {
            var irpagina = parseInt(paginador.data("pag")) - 1;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .next_link").click(function ()
        {
            var irpagina = parseInt(paginador.data("pag")) + 1;
            cargaPagina(irpagina);
            return false;
        });

        paginador.find("li .last_link").click(function ()
        {
            var irpagina = totalPaginas - 1;
            cargaPagina(irpagina);
            return false;
        });

        cargaPagina(0);

    }

    function cargaPagina(pagina)
    {
        var desde = pagina * itemsPorPagina;

        $.ajax({
            data: {"param1": "dame", "limit": itemsPorPagina, "offset": desde},
            type: "GET",
            dataType: "json",
            url: 'agenda/json-pagination'
        }).done(function (data, textStatus, jqXHR) {

            var lista = data.lista;

            $("#listConsul").html("");

            $.each(lista, function (ind, elem) {

                $(
                        "<li class='list-group-item list-group-item-info'>" + '<i class="glyphicon glyphicon-certificate"></i>' + '<b> Nome: </b>' + elem.agenda_pac + ' <b>Procedimento: </b>' + elem.agenda_proc + ' <b>Horario: </b>' + elem.agenda_start_normal + "</li>"

                        ).appendTo($("#listConsul"));

            });


        }).fail(function (jqXHR, textStatus, textError) {
            alert(textError);


        });

        if (pagina > 0)
        {

            paginador.find(".prev_link").show();



        } else
        {
            paginador.find(".prev_link").hide();
        }
        if (pagina < (totalPaginas - numerosPorPagina))
        {
            paginador.find(".next_link").show();
        } else
        {
            paginador.find(".next_link").hide();

        }

        paginador.data("pag", pagina);

        if (numerosPorPagina > 1)
        {

            $(".page_link").hide();
            if (pagina < (totalPaginas - numerosPorPagina))
            {
                $(".page_link").slice(pagina, numerosPorPagina + pagina).show();

            } else {
                if (totalPaginas > numerosPorPagina)
                    $(".page_link").slice(totalPaginas - numerosPorPagina).show();
                else
                    $(".page_link").slice(0).show();
            }

        }

        paginador.children().removeClass("active");
        paginador.children().eq(pagina + 2).addClass("active");

    }


    $(function () {
        $.ajax({
            data: {"param1": "quantos"},
            type: "GET",
            dataType: "json",
            url: 'agenda/json-pagination'
        }).done(function (data, textStatus, jqXHR) {
            var total = data.total;

            creaPaginador(total);

            if (total == '0') {
                $('.paginadorAgenda').html('<i class="glyphicon glyphicon-info-sign"></i> Olá, ainda não a agendamentos');
                $('.panel-footer').hide();

            } else {

                $('.paginadorAgenda').hide();
            }

        }).fail(function (jqXHR, textStatus, textError) {
            alert("Error al realizar la peticion quantos".textError);

        });

    });
});


// Monetario paginas com financeiros


    $(function (){
        var test = 'R$ 1.700,90';


        function getMoney( str )
        {
                return parseInt( str.replace(/[\D]+/g,'') );
        }
        function formatReal( int )
        {
                var tmp = int+'';
                tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                if( tmp.length > 6 )
                        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                return tmp;
        }


        //var int = getMoney( test );
        //alert( int );


        //console.log( formatReal( 1000 ) );
        //console.log( formatReal( 19990020 ) );
        //console.log( formatReal( 12006 ) );
        //console.log( formatReal( 111090 ) );
        //console.log( formatReal( 1111 ) );
        //console.log( formatReal( 120090 ) );
        //console.log( formatReal( int ) );
        
    });


// Rotina ajax CRUD página Contas a pagar
$(document).ready(function(){
  
  // On page load: datatable
  var table_pay = $('#finances-pay').dataTable({
    "ajax": "http://127.0.0.1/soc/finances-pay/ajax-process?job=get_pays",
    "columns": [
      { "data": "pay_id"},
      { "data": "pay_venc"},
      { "data": "pay_date_pay"},
      { "data": "pay_cat"},
      { "data": "pay_desc"},
      { "data": "pay_val"}
      
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [-1] }
    ],
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "oLanguage": {
      "oPaginate": {
        "sFirst":       " ",
        "sPrevious":    " ",
        "sNext":        " ",
        "sLast":        " "
      },
      "sLengthMenu":    "Records per page: _MENU_",
      "sInfo":          "Total of _TOTAL_ records (showing _START_ to _END_)",
      "sInfoFiltered":  "(filtered from _MAX_ total records)"
    }
  });
  
  // On page load: form validation
  jQuery.validator.setDefaults({
    success: 'valid',
    rules: {
      fiscal_year: {
        required: true,
        min:      2000,
        max:      2025
      }
    },
    errorPlacement: function(error, element){
      error.insertBefore(element);
    },
    highlight: function(element){
      $(element).parent('.field_container').removeClass('valid').addClass('error');
    },
    unhighlight: function(element){
      $(element).parent('.field_container').addClass('valid').removeClass('error');
    }
  });
  var form_company = $('#form_company');
  form_company.validate();

  // Show message
  function show_message(message_text, message_type){
    $('#message').html('<p>' + message_text + '</p>').attr('class', message_type);
    $('#message_container').show();
    if (typeof timeout_message !== 'undefined'){
      window.clearTimeout(timeout_message);
    }
    timeout_message = setTimeout(function(){
      hide_message();
    }, 8000);
  }
  // Hide message
  function hide_message(){
    $('#message').html('').attr('class', '');
    $('#message_container').hide();
  }

  // Show loading message
  function show_loading_message(){
    $('#loading_container').show();
  }
  // Hide loading message
  function hide_loading_message(){
    $('#loading_container').hide();
  }

  // Show lightbox
  function show_lightbox(){
    $('.lightbox_bg').show();
    $('.lightbox_container').show();
  }
  // Hide lightbox
  function hide_lightbox(){
    $('.lightbox_bg').hide();
    $('.lightbox_container').hide();
  }
  // Lightbox background
  $(document).on('click', '.lightbox_bg', function(){
    hide_lightbox();
  });
  // Lightbox close button
  $(document).on('click', '.lightbox_close', function(){
    hide_lightbox();
  });
  // Escape keyboard key
  $(document).keyup(function(e){
    if (e.keyCode == 27){
      hide_lightbox();
    }
  });
  
  // Hide iPad keyboard
  function hide_ipad_keyboard(){
    document.activeElement.blur();
    $('input').blur();
  }

  // Add company button
  $(document).on('click', '#add_company', function(e){
    e.preventDefault();
    $('.lightbox_content h2').text('Add company');
    $('#form_company button').text('Add company');
    $('#form_company').attr('class', 'form add');
    $('#form_company').attr('data-id', '');
    $('#form_company .field_container label.error').hide();
    $('#form_company .field_container').removeClass('valid').removeClass('error');
    $('#form_company #pay_id').val('');
    $('#form_company #company_name').val('');
    $('#form_company #industries').val('');
    $('#form_company #revenue').val('');
    $('#form_company #fiscal_year').val('');
    $('#form_company #employees').val('');
    $('#form_company #market_cap').val('');
    $('#form_company #headquarters').val('');
    show_lightbox();
  });

  // Add company submit form
  $(document).on('submit', '#form_company.add', function(e){
    e.preventDefault();
    // Validate form
    if (form_company.valid() == true){
      // Send company information to database
      hide_ipad_keyboard();
      hide_lightbox();
      show_loading_message();
      var form_data = $('#form_company').serialize();
      var request   = $.ajax({
        url:          'data.php?job=add_company',
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_pay.api().ajax.reload(function(){
            hide_loading_message();
            var company_name = $('#company_name').val();
            show_message("Company '" + company_name + "' added successfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Add request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Add request failed: ' + textStatus, 'error');
      });
    }
  });

  // Edit company button
  $(document).on('click', '.function_edit a', function(e){
    e.preventDefault();
    // Get company information from database
    show_loading_message();
    var id      = $(this).data('id');
    var request = $.ajax({
      url:          'data.php?job=get_company',
      cache:        false,
      data:         'id=' + id,
      dataType:     'json',
      contentType:  'application/json; charset=utf-8',
      type:         'get'
    });
    request.done(function(output){
      if (output.result == 'success'){
        $('.lightbox_content h2').text('Edit company');
        $('#form_company button').text('Edit company');
        $('#form_company').attr('class', 'form edit');
        $('#form_company').attr('data-id', id);
        $('#form_company .field_container label.error').hide();
        $('#form_company .field_container').removeClass('valid').removeClass('error');
        $('#form_company #pay_id').val(output.data[0].pay_id);
        $('#form_company #company_name').val(output.data[0].company_name);
        $('#form_company #industries').val(output.data[0].industries);
        $('#form_company #revenue').val(output.data[0].revenue);
        $('#form_company #fiscal_year').val(output.data[0].fiscal_year);
        $('#form_company #employees').val(output.data[0].employees);
        $('#form_company #market_cap').val(output.data[0].market_cap);
        $('#form_company #headquarters').val(output.data[0].headquarters);
        hide_loading_message();
        show_lightbox();
      } else {
        hide_loading_message();
        show_message('Information request failed', 'error');
      }
    });
    request.fail(function(jqXHR, textStatus){
      hide_loading_message();
      show_message('Information request failed: ' + textStatus, 'error');
    });
  });
  
  // Edit company submit form
  $(document).on('submit', '#form_company.edit', function(e){
    e.preventDefault();
    // Validate form
    if (form_company.valid() == true){
      // Send company information to database
      hide_ipad_keyboard();
      hide_lightbox();
      show_loading_message();
      var id        = $('#form_company').attr('data-id');
      var form_data = $('#form_company').serialize();
      var request   = $.ajax({
        url:          'data.php?job=edit_company&id=' + id,
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_pay.api().ajax.reload(function(){
            hide_loading_message();
            var company_name = $('#company_name').val();
            show_message("Company '" + company_name + "' edited successfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Edit request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Edit request failed: ' + textStatus, 'error');
      });
    }
  });
  
  // Delete company
  $(document).on('click', '.function_delete a', function(e){
    e.preventDefault();
    var company_name = $(this).data('name');
    if (confirm("Are you sure you want to delete '" + company_name + "'?")){
      show_loading_message();
      var id      = $(this).data('id');
      var request = $.ajax({
        url:          'data.php?job=delete_company&id=' + id,
        cache:        false,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_pay.api().ajax.reload(function(){
            hide_loading_message();
            show_message("Company '" + company_name + "' deleted successfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Delete request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Delete request failed: ' + textStatus, 'error');
      });
    }
  });

});