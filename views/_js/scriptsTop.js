
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
$(function(){
    
   //Mudançã de formulário
   
   $(document).bind("click", '.btn-editable', function() {
        console.log('Teste');
    });
   
    
    
  // Show loading message
  function show_loading_message(){
    //$('#loading_container').show();
    alert('Carregando edição...');
  }  
  // Carrega os dados e a tabela: datatable
  var table_pay = $('#finances-pay').dataTable({
    "language": {url: 'Portuguese-Brasil.json'},
    "dom": 'Bfrtip',
    "buttons": [{
        "extend": 'copy',
        "text": 'Copiar'},
    {
        "extend": 'excel',
        "text": 'Gerar excel'},
    {
        "extend": 'pdf',
        "text": 'Gerar PDF'}],
    "ajax": "finances-pay/ajax-process?job=get_pays",
    "columns": [
      { "data": "pay_id"},
      { "data": "pay_venc", "sClass": "text-center"},
      { "data": "pay_date_pay", "sClass": "text-center"},
      { "data": "pay_cat", "sClass": "text-center"},
      { "data": "pay_desc", "sClass": "text-center"},
      { "data": "pay_val", "sClass": "text-center"},
      { "data": "functions", "sClass": "text-center"}
      
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [-1] }
    ],
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
  });
  
  // Edit company button
  $(document).on('click', '.btn-editable', function(e){
    e.preventDefault();
    
    //Abre o formulario para edição
    $('.new-fees').show(500);
    $('#fees-btn-show').hide();
    $('#fees-btn-hide').show();
    $('html, body').animate({scrollTop:0}, 'slow');
    
    // Get company information from database
    show_loading_message();
    var id      = $(this).data('id');
    var request = $.ajax({
      url:          'finances-pay/ajax-process?job=get_pay',
      cache:        false,
      data:         'id=' + id,
      dataType:     'json',
      contentType:  'application/json; charset=utf-8',
      type:         'get'
    });
    
    console.log(request);
    request.done(function(output){
      if (output.result == 'success'){
            $('.title-cont').text('Edição');
            //$('#form_company button').text('Edit company');
            $('#form-register').attr('class', 'form edit');
            $('#form-register').attr('data-id', id);
            $('#form-register .field_container label.error').hide();
            $('#form-register .field_container').removeClass('valid').removeClass('error');
            $('#form-register #pay_venc').val(output.data[0].pay_venc);
            $('#form-register #pay_date_pay').val(output.data[0].pay_date_pay);
            $('#form-register #pay_desc').val(output.data[0].pay_desc);
            $('#form-register #pay_cat').val(output.data[0].pay_cat);
            $('#form-register #pay_val').val(output.data[0].pay_val);
            $('#form-register #employees').val(output.data[0].employees);
            $('#form-register #market_cap').val(output.data[0].market_cap);
            $('#form-register #headquarters').val(output.data[0].headquarters);
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
  
});

